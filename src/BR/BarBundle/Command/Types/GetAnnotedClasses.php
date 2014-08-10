<?php
namespace BR\BarBundle\Command\Types;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Bundle\DoctrineBundle\Mapping\DisconnectedMetadataFactory;

trait GetAnnotedClasses
{
    public function getAnnotatedClasses($driver, $annotationClass) {
        $reader = new AnnotationReader();
        $bundle = $this->getApplication()->getKernel()->getBundle("BRBarBundle");
        $manager = new DisconnectedMetadataFactory($driver);
        $metadata = $manager->getBundleMetadata($bundle);
        // Lists doctrine entities classes with GenerateType annotation
        $classes = array();
        foreach ($metadata->getMetadata() as $m) {
            $class = new \ReflectionClass($m->getName());
            $annotation = $reader->getClassAnnotation($class, $annotationClass);
            if($annotation != null) {
                $classes[] = array(
                    "class" => $class,
                    "annotation" => $annotation
                );
            }
        }
        return $classes;
    }
}
