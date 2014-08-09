<?php
namespace BR\BarBundle\Controller;

use JMS\Serializer\SerializerInterface;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\DeserializationContext;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

class FormSerializer implements SerializerInterface
{
    protected $serializer;

    public function __construct (SerializerInterface $serializer) {
        $this->serializer = $serializer;
    }

    public function serialize($data, $format, SerializationContext $context = null) {
        if($data instanceof FormInterface) {
            $data = $this->serializeFormView($data->createView());
        }
        return $this->serializer->serialize($data, $format, $context);
    }

    public function deserialize($data, $type, $format, DeserializationContext $context = null) {
        return $this->serializer->deserialize($data, $type, $format, $context);
    }

    private function serializeFormView(FormView $v) {
        if(!is_object($v->vars["value"])) {
            return $v->vars["value"];
        }

        $a = array();
        foreach ($v->children as $key => $child) {
            $a[$key] = $this->serializeFormView($child);
        }
        unset($a["_token"]);
        return $a;
    }
}
