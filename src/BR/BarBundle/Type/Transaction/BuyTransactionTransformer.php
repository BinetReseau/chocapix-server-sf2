<?php
namespace BR\BarBundle\Type\Transaction;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;


class BuyTransactionTransformer implements DataTransformerInterface
{
    private $repo;

    /**
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om) {
        $this->repo = $om->getRepository("BRBarBundle:Transaction\BuyTransaction");
    }

    public function transform($entity) {
        if ($entity === null) {
            return null;
        }

        $normalizer = new GetSetMethodNormalizer();
        $normalizer->setIgnoredAttributes(array('operations', 'bar', 'author', 'timestamp'));
        $encoders = array(new JsonEncoder());
        $serializer = new Serializer(array($normalizer), $encoders);

        $obj = $serializer->normalize($entity);
        $obj['bar'] = $entity->getBar();
        $obj['author'] = $entity->getAuthor();
        $obj['timestamp'] = $entity->getTimestamp();
        $obj['item'] = $entity->getItem();
        $obj['qty'] = $entity->getQty();
        return $obj;
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
