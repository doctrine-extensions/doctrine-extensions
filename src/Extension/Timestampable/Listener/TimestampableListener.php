<?php

namespace DoctrineExtensions\Extension\Timestampable\Listener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use DoctrineExtensions\Common\Metadata\ExtendedClassMetadata;
use DoctrineExtensions\Extension\Timestampable\Annotation\Sluggable;
use DoctrineExtensions\Extension\Timestampable\Annotation\Timestampable;
use Symfony\Component\PropertyAccess\PropertyAccess;

class TimestampableListener implements EventSubscriber
{
    public function getSubscribedEvents()
    {
        return [
            Events::prePersist,
            Events::preUpdate,
        ];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $this->updateTimestamp($args, Events::prePersist);
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $this->updateTimestamp($args, Events::preUpdate);
    }

    private function updateTimestamp(LifecycleEventArgs $args, string $event)
    {
        $entity = $args->getEntity();
        /** @var ExtendedClassMetadata $metadata */
        $metadata = $args->getEntityManager()->getClassMetadata(get_class($entity));

        if (null !== $timestampable = $metadata->getExtensionMetadata(Timestampable::class)) {
            $accessor = PropertyAccess::createPropertyAccessor();
            $date = new \DateTime();

            /**
             * @var string $name
             * @var Timestampable $annotation
             */
            foreach ($timestampable['fields'] as $name => $annotation) {
                if ($event === Events::prePersist && $annotation->onPersist) {
                    $accessor->setValue($entity, $name, $date);
                } elseif ($event === Events::preUpdate && $annotation->onUpdate) {
                    $accessor->setValue($entity, $name, $date);
                }
            }
        }
    }
}
