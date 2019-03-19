<?php

namespace DoctrineExtensions\Common\Metadata\Driver;

use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\Persistence\Mapping\ClassMetadata;

interface AnnotationDriverExtensionInterface
{
    public function loadMetadataForClass(Reader $reader, string $className, ClassMetadata $metadata);
}
