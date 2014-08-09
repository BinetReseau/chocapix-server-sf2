<?php
namespace BR\BarBundle\Type;

use Symfony\Component\Type\DataTransformerInterface;
use Symfony\Component\Type\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;

class EntityIdTransformer implements DataTransformerInterface
{
    private $repo;

    private $entityClassName;

    private $name;

    /**
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om, $entityClassName, $name) {
        $this->repo = $om->getRepository($entityClassName);
        $this->entityClassName = $entityClassName;
        $this->name = $name;
    }

    public function transform($entity) {
        if ($entity === null) {
            return null;
        }
        return $entity->getId();
    }

    public function reverseTransform($id) {
        if (!$id) {
            return null;
        }
        $entity = $this->repo->find($id);
        if ($entity === null) {
            throw new TransformationFailedException(sprintf('A "%s" with id "%s" does not exist!', $this->entityClassName, $id));
        }
        return $entity;
    }
}
