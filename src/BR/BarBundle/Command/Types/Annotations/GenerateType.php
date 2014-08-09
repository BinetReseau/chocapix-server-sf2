<?php
namespace BR\BarBundle\Command\Types\Annotations;

/**
 * @Annotation
 */
class GenerateType
{
    private $type_name;
    private $gen_type = false;
    private $gen_typeid = false;

    public function __construct($options) {
        if (isset($options['value'])) {
            $options['type_name'] = $options['value'];
            unset($options['value']);
        }

        foreach ($options as $key => $value) {
            if (!property_exists($this, $key)) {
                throw new \InvalidArgumentException(sprintf('Property "%s" does not exist', $key));
            }

            $this->$key = $value;
        }
    }

    public function getTypeName() {
        return $this->type_name;
    }

    public function genTypeClass() {
        return property_exists($this, "gen_type") ? $this->gen_type : false;
    }
    public function genTypeIdClass() {
        return property_exists($this, "gen_typeid") ? $this->gen_typeid : false;
    }
}
