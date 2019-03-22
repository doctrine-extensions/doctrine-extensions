<?php

namespace DoctrineExtensions\Extension\Timestampable\Tests\Metadata\Driver;

use Doctrine\Common\Annotations\AnnotationReader;
use DoctrineExtensions\Common\Metadata\ExtendedClassMetadata;
use DoctrineExtensions\Extension\Timestampable\Annotation\Timestampable;
use DoctrineExtensions\Extension\Timestampable\Metadata\Driver\TimestampableDriverExtension;
use DoctrineExtensions\Extension\Timestampable\Tests\Fixtures\Entity\TimestampableEntity;
use PHPUnit\Framework\TestCase;

class TimestampableDriverExtensionTest extends TestCase
{
    public function testLoadMetadataForClass()
    {
        $annotation = new Timestampable();

        $reader = $this->createMock(AnnotationReader::class);
        $reader->expects($this->at(0))->method('getPropertyAnnotation')->willReturn(null); // id
        $reader->method('getPropertyAnnotation')->willReturn($annotation);

        $metadata = $this->createMock(ExtendedClassMetadata::class);
        $metadata->expects($this->at(0))->method('addExtensionFieldMetadata')->with(Timestampable::class, 'createdAt', $annotation);
        $metadata->expects($this->at(1))->method('addExtensionFieldMetadata')->with(Timestampable::class, 'updatedAt', $annotation);

        $driverExtension = new TimestampableDriverExtension();
        $driverExtension->loadMetadataForClass($reader, TimestampableEntity::class, $metadata);
    }
}
