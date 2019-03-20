<?php

namespace DoctrineExtensions\Extension\Sluggable\Tests\Listener;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Event\LifecycleEventArgs;
use DoctrineExtensions\Common\Metadata\ExtendedClassMetadata;
use DoctrineExtensions\Extension\Sluggable\Annotation\Sluggable;
use DoctrineExtensions\Extension\Sluggable\Listener\SluggableListener;
use DoctrineExtensions\Extension\Sluggable\Tests\Fixtures\Entity\SluggableEntity;
use PHPUnit\Framework\TestCase;

class SluggableListenerTest extends TestCase
{
    private $args;

    public function setUp(): void
    {
        $annotataion = new Sluggable();
        $annotataion->fields = ['title'];

        $entity = $this->createMock(SluggableEntity::class);
        $entity->expects($this->once())->method('setSimple');
        $entity->expects($this->never())->method('setMultiple');

        $metadata = $this->createMock(ExtendedClassMetadata::class);
        $metadata->method('getExtensionMetadata')->willReturn(
            [
                'fields' => [
                    'simple' => $annotataion,
                ]
            ]
        );

        $em = $this->createMock(EntityManager::class);
        $em->method('getClassMetadata')->with(get_class($entity))->willReturn($metadata);

        $args = $this->createMock(LifecycleEventArgs::class);
        $args->method('getEntityManager')->willReturn($em);
        $args->method('getEntity')->willReturn($entity);

        $this->args = $args;
    }

    public function testPrePersist()
    {
        $listener = new SluggableListener();
        $listener->prePersist($this->args);
    }

    public function testPreUpdate()
    {
        $listener = new SluggableListener();
        $listener->prePersist($this->args);
    }
}
