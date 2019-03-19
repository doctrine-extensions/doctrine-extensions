<?php

namespace DoctrineExtensions\Extension\Sluggable\Listener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use DoctrineExtensions\Common\Metadata\ExtendedClassMetadata;
use DoctrineExtensions\Extension\Sluggable\Annotation\Sluggable;
use Symfony\Component\PropertyAccess\PropertyAccess;

class SluggableListener implements EventSubscriber
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
        $this->updateSlug($args);
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $this->updateSlug($args);
    }

    private function updateSlug(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        /** @var ExtendedClassMetadata $metadata */
        $metadata = $args->getEntityManager()->getClassMetadata(get_class($entity));

        if (null !== $sluggable = $metadata->getExtensionMetadata(Sluggable::class)) {
            $accessor = PropertyAccess::createPropertyAccessor();

            /**
             * @var string $name
             * @var Sluggable $annotation
             */
            foreach ($sluggable['fields'] as $name => $annotation) {
                $callback = is_string($annotation->callback) ? new $annotation->callback : $annotation->callback;

                $slug = call_user_func($callback, $entity, $annotation->fields, $annotation->separator, $annotation->glue);
                $accessor->setValue($entity, $name, $slug);
            }
        }
    }
}
