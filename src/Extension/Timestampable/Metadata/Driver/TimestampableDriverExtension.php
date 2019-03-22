<?php

namespace DoctrineExtensions\Extension\Timestampable\Metadata\Driver;

use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\Persistence\Mapping\ClassMetadata;
use DoctrineExtensions\Common\Metadata\Driver\AnnotationDriverExtensionInterface;
use DoctrineExtensions\Common\Metadata\ExtendedClassMetadata;
use DoctrineExtensions\Extension\Timestampable\Annotation\Timestampable;

class TimestampableDriverExtension implements AnnotationDriverExtensionInterface
{
    public function loadMetadataForClass(Reader $reader, string $className, ClassMetadata $metadata)
    {
        /* @var $metadata ExtendedClassMetadata */

        $refl = new \ReflectionClass($className);

        foreach ($refl->getProperties() as $property) {
            $field = $property->getName();

            if (null === $annotation = $reader->getPropertyAnnotation($property, Timestampable::class)) {
                continue;
            }

            $metadata->addExtensionFieldMetadata(Timestampable::class, $field, $annotation);
        }
    }
}
