<?php
/**
 * Created by PhpStorm.
 * User: pierrick
 * Date: 20/06/2017
 * Time: 11:53
 */

namespace AppBundle\Security;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Id\UuidGenerator;

/**
 * Class IdGenerator
 * @package AppBundle\Security
 */
class IdGenerator extends UuidGenerator
{
    /**
     * Pre-generate Entity unique ID
     *
     * @param EntityManager $em
     * @param \Doctrine\ORM\Mapping\Entity $entity
     * @return mixed
     */
    public function generate(EntityManager $em, $entity)
    {
        if (is_object($entity) and $entity->getId() !== null) {
            return $entity->getId();
        }

        $id = parent::generate($em, $entity);

        return str_replace('-', '', $id);
    }
}