<?php

namespace DoctrineExtensions\Extension\Sluggable\Tests\Metadata\Driver;

use Doctrine\Common\Annotations\AnnotationReader;
use DoctrineExtensions\Common\Metadata\ExtendedClassMetadata;
use DoctrineExtensions\Extension\Sluggable\Annotation\Sluggable;
use DoctrineExtensions\Extension\Sluggable\Metadata\Driver\SluggableDriverExtension;
use DoctrineExtensions\Extension\Sluggable\Tests\Fixtures\Entity\SluggableEntity;
use PHPUnit\Framework\TestCase;

class SluggableDriverExtensionTest extends TestCase
{
    public function testLoadMetadataForClass()
    {
        $annotation = new Sluggable();

        $reader = $this->createMock(AnnotationReader::class);
        $reader->expects($this->at(3))->method('getPropertyAnnotation')->with($this->callback(function (\ReflectionProperty $property) {
            return $property->name === 'simple';
        }), Sluggable::class)->willReturn($annotation);

        $reader->method('getPropertyAnnotation')->willReturn(null);

        $metadata = $this->createMock(ExtendedClassMetadata::class);
        $metadata->expects($this->once())->method('addExtensionFieldMetadata');

        $driverExtension = new SluggableDriverExtension();
        $driverExtension->loadMetadataForClass($reader, SluggableEntity::class, $metadata);
    }
}
