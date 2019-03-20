<?php

namespace DoctrineExtensions\Extension\Timestampable\Tests\Fixtures\Entity;

use Doctrine\ORM\Mapping as ORM;
use DoctrineExtensions\Extension\Timestampable\Traits\TimestampableEntityTrait;

/**
 * @ORM\Entity()
 */
class TimestampableEntity
{
    use TimestampableEntityTrait;

    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
}
