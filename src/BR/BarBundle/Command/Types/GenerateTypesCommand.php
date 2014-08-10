<?php
namespace BR\BarBundle\Command\Types;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;


class GenerateTypesCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('brbar:generate:types')
            ->addOption('overwrite', null, InputOption::VALUE_NONE, 'Overwrite existing files');
    }


    protected function generateTypeId($entity, $overwrite = false) {
        $dir = 'src/BR/BarBundle/Type/' . $entity['namespace'];
        if(!is_dir($dir))
            mkdir($dir);
        $file = $entity['class'] . 'IdType.php';
        if(!is_file($dir . '/' . $file) || $overwrite) {
            file_put_contents($dir . '/' . $file,
                $this->getContainer()->get('templating')->render(
                    'BRBarBundle:Command/Types:IdTypeTemplate.php.twig',
                    $entity));
            return $entity['namespace'] . '/' . $file;
        }
        return false;
    }

    protected function generateType($entity, $metadata, $overwrite = false) {
        $dir = 'src/BR/BarBundle/Type/' . $entity['namespace'];
        if(!is_dir($dir))
            mkdir($dir);
        $file = $entity['class'] . 'Type.php';
        if(!is_file($dir . '/' . $file) || $overwrite) {
            file_put_contents($dir . '/' . $file,
                $this->getContainer()->get('templating')->render(
                    'BRBarBundle:Command/Types:TypeTemplate.php.twig',
                    $entity));
            return $entity['namespace'] . '/' . $file;
        }
        return false;
    }

    protected function generateServices($entities) {
        file_put_contents(
                'src/BR/BarBundle/Type/services.yml',
                $this->getContainer()->get('templating') ->render(
                    'BRBarBundle:Command/Types:services.yml.twig',
                    array('entities' => $entities)));
    }

    protected function parseMetadata($file) {
        $string = file_get_contents($file);
        $json = json_decode($string, true);

        $metadata = array();
        foreach($json["structural_types"] as $classdef) {
            $o = array();
                $full_class_name = $classdef["namespace"] . "." . $classdef["short_name"];
                $full_class_name = str_replace(".", "\\", $full_class_name);
                $o["full_class_name"] = $full_class_name;

                $properties = array();
                    foreach($classdef["data_properties"] as $p) {
                        $p["is_entity"] = false;
                        $properties[$p["name"]] = $p;
                    }
                    if(isset($classdef["navigation_properties"])) {
                    foreach($classdef["navigation_properties"] as $p) {
                        $entity_class_name = $p["entity_type_name"];
                        $entity_class_name = preg_replace("/^(.+):#(.+)/", "$2.$1", $entity_class_name);
                        $entity_class_name = str_replace(".", "\\", $entity_class_name);
                        if(isset($p["foreign_key_names"])) {
                        foreach($p["foreign_key_names"] as $key) {
                            $properties[$key]["is_entity"] = true;
                            $properties[$key]["entity_class"] = $entity_class_name;
                            $properties[$p["name"]] = $properties[$key];
                            $properties[$p["name"]]["name"] = $p["name"];
                            unset($properties[$key]);
                        }
                        }
                    }}

                $o["properties"] = $properties;

            $metadata[$full_class_name] = $o;
        }

        return $metadata;
    }

    protected function constructEntities($metadata, $annotatedclasses) {
        $entities = array();
        $name_map = array();
        foreach ($annotatedclasses as $o) {
            $full_class_name = $o["class"]->getName();
            $annotation = $o["annotation"];

            $a = preg_replace("/^BR\\\\BarBundle\\\\/", "", $full_class_name);
            $a = preg_replace("/^Entity\\\\/", "", $a);
            $a = explode("\\", $a);
            $className = array_slice($a, -1)[0];
            $namespace = array_slice($a, 0, sizeof($a) - 1);
            $namespace = array_diff($namespace, array('BR', 'BarBundle', 'Entity'));

            $o = array(
                'namespace' => implode("\\", $namespace),
                'class' => $className,
                'full_class_name' => $full_class_name,
                'short_name' => $annotation->getTypeName(),
                'gen_type' => $annotation->genTypeClass(),
                'gen_typeid' => $annotation->genTypeIdClass(),
                'parent' => $annotation->getParent()); // parent form type

            if(isset($metadata[$full_class_name])) {
                $name_map[$full_class_name] = $o['short_name'];
                $o = array_merge($o, $metadata[$full_class_name]);
            }
            $entities[] = $o;
        }

        // Need name_map full
        foreach($entities as $k => $entity) {
            foreach ($entity['properties'] as $l => $p) {
                if($p['is_entity']){
                    $entities[$k]['properties'][$l]['entity_name'] = $name_map[$p['entity_class']];
                }
            }
        }

        return $entities;
    }


    use GetAnnotedClasses;

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $metadata = $this->parseMetadata("src/BR/BarBundle/Resources/metadata.json");

        $annotatedclasses = $this->getAnnotatedClasses($this->getContainer()->get('doctrine'),
            'BR\\BarBundle\\Command\\Types\\Annotations\\GenerateType');

        $entities = $this->constructEntities($metadata, $annotatedclasses);

        $overwrite = $input->getOption('overwrite');
        $donesth = false;
        foreach ($entities as $entity) {
            if($entity['gen_typeid']){
                if($f = $this->generateTypeId($entity, $overwrite)) {
                    $output->writeln("Generated $f");
                    $donesth = true;
                }
            }
            if($entity['gen_type']){
                if($f = $this->generateType($entity, $metadata, $overwrite)) {
                    $output->writeln("Generated $f");
                    $donesth = true;
                }
            }
        }
        if(!$donesth) {
            $output->writeln("Nothing to do");
        }

        $this->generateServices($entities);
        $output->writeln("Generated Type/services.yml");
    }
}
