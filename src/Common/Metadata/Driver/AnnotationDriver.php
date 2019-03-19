<?php

namespace DoctrineExtensions\Common\Metadata\Driver;

use Doctrine\Common\Persistence\Mapping\ClassMetadata;
use DoctrineExtensions\Common\Metadata\ExtendedClassMetadata;

class AnnotationDriver extends \Doctrine\ORM\Mapping\Driver\AnnotationDriver
{
    /**
     * @var AnnotationDriverExtensionInterface[]
     */
    private $extensions = [];

    public function addExtension(AnnotationDriverExtensionInterface $annotationDriverExtension)
    {
        $this->extensions[] = $annotationDriverExtension;

        return $this;
    }

    public function getExtensions(): array
    {
        return $this->extensions;
    }

    public function loadMetadataForClass($className, ClassMetadata $metadata)
    {
        /** @var ExtendedClassMetadata $metadata */

        parent::loadMetadataForClass($className, $metadata);

        foreach ($this->extensions as $extension) {
            $extension->loadMetadataForClass($this->reader, $className, $metadata);
        }
    }
}
