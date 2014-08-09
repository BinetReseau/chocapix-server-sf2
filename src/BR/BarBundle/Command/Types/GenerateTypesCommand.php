<?php
namespace BR\BarBundle\Command\Types;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Bundle\DoctrineBundle\Mapping\DisconnectedMetadataFactory;


class GenerateTypesCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('brbar:generate:types');
    }

    protected function generateTypes($entities) {
        foreach ($entities as $i => $entity) {
            $dir = 'src/BR/BarBundle/Type/' . $entity['namespace'];
            if(!is_dir($dir))
                mkdir($dir);
            if($entity['gen_typeid']){
                $file = $dir . '/' . $entity['class'] . 'IdType.php';
                if(!is_file($file)) {
                    file_put_contents($file,
                        $this->getContainer()->get('templating')->render(
                            'BRBarBundle:Command/Types:IdTypeTemplate.php.twig',
                            $entity));
                }
            }
        }
    }

    protected function generateServices($entities) {
        file_put_contents(
                'src/BR/BarBundle/Type/services.yml',
                $this->getContainer()->get('templating') ->render(
                    'BRBarBundle:Command/Types:services.yml.twig',
                    array('entities' => $entities)));
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $reader = new AnnotationReader();
        $entities = array();


        $manager = new DisconnectedMetadataFactory($this->getContainer()->get('doctrine'));

        $bundle = $this->getApplication()->getKernel()->getBundle("BRBarBundle");
        $metadata = $manager->getBundleMetadata($bundle);

        // Lists doctrine entities classes
        foreach ($metadata->getMetadata() as $m) {
            $class = $m->getName();
            $annotation = $reader->getClassAnnotation(new \ReflectionClass($class), 'BR\\BarBundle\\Command\\Types\\Annotations\\GenerateType');

            if ($annotation !== null) {
                $a = preg_replace("/^BR\\\\BarBundle\\\\/", "", $class);
                $a = preg_replace("/^Entity\\\\/", "", $a);
                $output->writeln("Generating types for " . $a);
                $a = explode("\\", $a);
                $className = array_slice($a, -1)[0];
                $namespace = array_slice($a, 0, sizeof($a) - 1);
                $namespace = array_diff($namespace, array('BR', 'BarBundle', 'Entity'));

                $entities[] = array(
                    'namespace' => implode("\\", $namespace),
                    'class' => $className,
                    'short_name' => $annotation->getTypeName(),
                    'gen_type' => $annotation->genTypeClass(),
                    'gen_typeid' => $annotation->genTypeIdClass());
            }
        }

        $this->generateTypes($entities);
        $this->generateServices($entities);
    }
}
