<?php

namespace DoctrineExtensions\Extension\Sluggable\Metadata\Driver;

use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\Persistence\Mapping\ClassMetadata;
use DoctrineExtensions\Common\Metadata\Driver\AnnotationDriverExtensionInterface;
use DoctrineExtensions\Common\Metadata\ExtendedClassMetadata;
use DoctrineExtensions\Extension\Sluggable\Annotation\Sluggable;

class SluggableDriverExtension implements AnnotationDriverExtensionInterface
{
    public function loadMetadataForClass(Reader $reader, string $className, ClassMetadata $metadata)
    {
        /* @var $metadata ExtendedClassMetadata */

        $refl = new \ReflectionClass($className);

        foreach ($refl->getProperties() as $property) {
            $field = $property->getName();

            if (null === $annotation = $reader->getPropertyAnnotation($property, Sluggable::class)) {
                continue;
            }

            $metadata->addExtensionFieldMetadata(Sluggable::class, $field, $annotation);
        }
    }
}
