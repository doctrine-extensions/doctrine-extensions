<?php

namespace DoctrineExtensions\Common\Tests\Metadata\Driver;

use Doctrine\Common\Annotations\AnnotationReader;
use DoctrineExtensions\Common\Metadata\Driver\AnnotationDriver;
use DoctrineExtensions\Common\Metadata\Driver\AnnotationDriverExtensionInterface;
use DoctrineExtensions\Common\Metadata\ExtendedClassMetadata;
use DoctrineExtensions\Common\Tests\Fixture\Entity\Dummy;
use PHPUnit\Framework\TestCase;

class AnnotationDriverTest extends TestCase
{
    public function testAddExtension()
    {
        $reader = $this->createMock(AnnotationReader::class);
        $driver = new AnnotationDriver($reader);
        $extension = $this->createMock(AnnotationDriverExtensionInterface::class);

        $this->assertSame($driver, $driver->addExtension($extension));
    }

    public function testGetExtensions()
    {
        $reader = $this->createMock(AnnotationReader::class);
        $driver = new AnnotationDriver($reader);
        $extension = $this->createMock(AnnotationDriverExtensionInterface::class);

        $driver->addExtension($extension);

        $this->assertCount(1, $driver->getExtensions());
    }

    public function testLoadMetadataForClass()
    {
        $reader = new AnnotationReader();
        $driver = new AnnotationDriver($reader, [__DIR__ . '/../../Fixture/Entity']);
        $metadata = $this->createMock(ExtendedClassMetadata::class);
        $metadata->name = Dummy::class;
        $extension = $this->createMock(AnnotationDriverExtensionInterface::class);
        $extension->expects($this->once())->method('loadMetadataForClass');

        $driver->addExtension($extension);

        $driver->loadMetadataForClass(Dummy::class, $metadata);
    }
}
