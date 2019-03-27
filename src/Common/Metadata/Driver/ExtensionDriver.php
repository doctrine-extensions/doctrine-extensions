<?php

namespace DoctrineExtensions\Common\Metadata\Driver;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Persistence\Mapping\ClassMetadata;
use Doctrine\Common\Persistence\Mapping\Driver\MappingDriver;
use DoctrineExtensions\Common\Metadata\ExtendedClassMetadata;

class ExtensionDriver implements MappingDriver
{
    private $driver;
    private $reader;

    public function __construct(MappingDriver $driver, AnnotationReader $reader)
    {
        $this->driver = $driver;
        $this->reader = $reader;
    }

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

        $this->driver->loadMetadataForClass($className, $metadata);

        foreach ($this->extensions as $extension) {
            $extension->loadMetadataForClass($this->reader, $className, $metadata);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getAllClassNames()
    {
        $this->driver->getAllClassNames();
    }

    /**
     * {@inheritdoc}
     */
    public function isTransient($className)
    {
        return $this->driver->isTransient($className);
    }
}
