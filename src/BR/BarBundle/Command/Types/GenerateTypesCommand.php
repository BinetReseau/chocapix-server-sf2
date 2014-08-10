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
        if($entity['gen_typeid']){
            $file = $entity['class'] . 'IdType.php';
            if(!is_file($dir . '/' . $file) || $overwrite) {
                file_put_contents($dir . '/' . $file,
                    $this->getContainer()->get('templating')->render(
                        'BRBarBundle:Command/Types:IdTypeTemplate.php.twig',
                        $entity));
                return $entity['namespace'] . '/' . $file;
            }
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

    use GetAnnotedClasses;

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $entities = array();
        $annotatedclasses = $this->getAnnotatedClasses($this->getContainer()->get('doctrine'),
            'BR\\BarBundle\\Command\\Types\\Annotations\\GenerateType');

        foreach ($annotatedclasses as $o) {
            $class = $o["class"]->getName();
            $annotation = $o["annotation"];

            $a = preg_replace("/^BR\\\\BarBundle\\\\/", "", $class);
            $a = preg_replace("/^Entity\\\\/", "", $a);
            $a = explode("\\", $a);
            $className = array_slice($a, -1)[0];
            $namespace = array_slice($a, 0, sizeof($a) - 1);
            $namespace = array_diff($namespace, array('BR', 'BarBundle', 'Entity'));

            $entities[] = array(
                'namespace' => implode("\\", $namespace),
                'class' => $className,
                'full_class_name' => $class,
                'short_name' => $annotation->getTypeName(),
                'gen_type' => $annotation->genTypeClass(),
                'gen_typeid' => $annotation->genTypeIdClass(),
                'parent' => $annotation->getParent()); // parent form type
        }


        $overwrite = $input->getOption('overwrite');
        foreach ($entities as $entity) {
            // if($f = $this->generateType($entity, $overwrite)) {
            //     $output->writeln("Generated $f");
            // }
            if($f = $this->generateTypeId($entity, $overwrite)) {
                $output->writeln("Generated $f");
            }
        }

        $this->generateServices($entities);
        $output->writeln("Generated Type/services.yml");
    }
}
