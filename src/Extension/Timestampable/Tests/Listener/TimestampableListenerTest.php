<?php

namespace DoctrineExtensions\Extension\Timestampable\Tests\Listener;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Event\LifecycleEventArgs;
use DoctrineExtensions\Common\Metadata\ExtendedClassMetadata;
use DoctrineExtensions\Extension\Timestampable\Annotation\Timestampable;
use DoctrineExtensions\Extension\Timestampable\Listener\TimestampableListener;
use DoctrineExtensions\Extension\Timestampable\Tests\Fixtures\Entity\TimestampableEntity;
use PHPUnit\Framework\TestCase;

class TimestampableListenerTest extends TestCase
{
    /**
     * @var Timestampable
     */
    private $annotation;
    private $args;

    public function setUp(): void
    {
        $annotation = new Timestampable();

        $metadata = $this->createMock(ExtendedClassMetadata::class);
        $metadata->expects($this->once())->method('getExtensionMetadata')->willReturn(
            [
                'fields' => [
                    'createdAt' => $annotation,
                ],
            ]
        );

        $entity = $this->createMock(TimestampableEntity::class);
        $entity->expects($this->once())->method('setCreatedAt');

        $em = $this->createMock(EntityManager::class);
        $em->method('getClassMetadata')->with(get_class($entity))->willReturn($metadata);

        $args = $this->createMock(LifecycleEventArgs::class);
        $args->method('getEntity')->willReturn($entity);
        $args->method('getEntityManager')->willReturn($em);

        $this->args = $args;
        $this->annotation = $annotation;
    }

    public function testPersist()
    {
        $this->annotation->onPersist = true;

        $listener = new TimestampableListener();
        $listener->prePersist($this->args);
    }

    public function testUpdate()
    {
        $this->annotation->onUpdate = true;

        $listener = new TimestampableListener();
        $listener->preUpdate($this->args);
    }
}
