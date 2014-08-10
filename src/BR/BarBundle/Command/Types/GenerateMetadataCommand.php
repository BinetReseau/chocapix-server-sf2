<?php
namespace BR\BarBundle\Command\Types;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

use Adrotec\BreezeJs\Doctrine\ORM\Dispatcher;
use Adrotec\BreezeJs\MetadataInterceptor;
use Adrotec\BreezeJs\Serializer\MetadataInterceptor as SerializerInterceptor;
use Adrotec\BreezeJs\Validator\ValidatorInterceptor;


class GenerateMetadataCommand extends ContainerAwareCommand
{
    protected function configure() {
        $this->setName('brbar:generate:metadata')
            ->addOption('overwrite', null, InputOption::VALUE_NONE, 'Overwrite existing files');
    }

    use GetAnnotedClasses;

    protected function execute(InputInterface $input, OutputInterface $output) {
        $metadata = null;
        /* @var $serializer \JMS\Serializer\Serializer */
        $serializer = $this->getContainer()->get('serializer');
        $validator = $this->getContainer()->get('validator');

        $interceptor = new MetadataInterceptor();
        $interceptor->add(new SerializerInterceptor($serializer));
        $interceptor->add(new ValidatorInterceptor($validator));

        $dispatcher = new Dispatcher($this->getContainer()->get('doctrine')->getManager(), $interceptor);

        $classes = $this->getAnnotatedClasses($this->getContainer()->get('doctrine'),
            'BR\\BarBundle\\Command\\Types\\Annotations\\GenerateType');
        $classes = array_map(function($x){return $x["class"]->getName();}, $classes);
        $dispatcher->setClasses($classes);

        $metadata = $dispatcher->getMetadata();
        $metadata = $serializer->serialize($metadata, 'json');

        $file = 'src/BR/BarBundle/Resources/metadata.json';
        if(!is_file($file) || $input->getOption('overwrite')) {
            file_put_contents($file, $metadata);
            $output->writeln("Generated Resources/metadata.json");
        }
    }
}
