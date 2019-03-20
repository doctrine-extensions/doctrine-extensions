<?php

namespace DoctrineExtensions\Extension\Timestampable\Tests\Functional;

use DoctrineExtensions\Common\Test\AbstractFunctionalTestCase;
use DoctrineExtensions\Extension\Timestampable\Listener\TimestampableListener;
use DoctrineExtensions\Extension\Timestampable\Metadata\Driver\TimestampableDriverExtension;
use DoctrineExtensions\Extension\Timestampable\Tests\Fixtures\Entity\TimestampableEntity;

class TimestampableTest extends AbstractFunctionalTestCase
{
    /**
     * @var TimestampableEntity
     */
    private $entity;

    public function getUsedEntityFixtures(): array
    {
        return [
            TimestampableEntity::class,
        ];
    }

    public function getUsedExtensions(): array
    {
        return [
            new TimestampableDriverExtension(),
        ];
    }

    public function getUsedEventSubscribers(): array
    {
        return [
            new TimestampableListener(),
        ];
    }

    public function setUp(): void
    {
        parent::setUp();

        $this->entity = new TimestampableEntity();
    }

    public function testPersist()
    {
        $this->em->persist($this->entity);
        $this->em->flush();

        $this->assertInstanceOf(\DateTime::class, $this->entity->getCreatedAt());
        $this->assertNull($this->entity->getUpdatedAt());
    }


    public function testUpdate()
    {
        $this->em->persist($this->entity);
        $this->em->flush();

        $this->entity->setCreatedAt(new \DateTime());
        $this->em->flush();

        $this->assertInstanceOf(\DateTime::class, $this->entity->getCreatedAt());
        $this->assertInstanceOf(\DateTime::class, $this->entity->getUpdatedAt());
    }
}
