<?php
namespace BR\BarBundle\Tools;

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
            // $data = $data->createView();
        }
        return $this->serializer->serialize($data, $format, $context);
    }

    public function deserialize($data, $type, $format, DeserializationContext $context = null) {
        return $this->serializer->deserialize($data, $type, $format, $context);
    }

    private function serializeFormView(FormView $v) {
        if(count($v->children) == 0) {
            return $v->vars;
        }

        $a = array();
        foreach ($v->children as $key => $child) {
            $o = $this->serializeFormView($child);
            if(isset($o["block_prefixes"])) {
                if(in_array("checkbox", $o["block_prefixes"])) {
                    $o["value"] = $o["checked"];
                }
                if(in_array("integer", $o["block_prefixes"])) {
                    $o["value"] = intval($o["value"]);
                }
                if(in_array("number", $o["block_prefixes"])) {
                    $o["value"] = floatval($o["value"]);
                }
            }
            // unset($o["form"]);
            // $a[$key] = $o;
            if(isset($o["value"])) {
                $a[$key] = $o["value"];
            } else {
                $a[$key] = $o;
            }
        }
        unset($a["_token"]);
        return $a;
    }
}
