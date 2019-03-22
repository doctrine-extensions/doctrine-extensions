<?php

namespace DoctrineExtensions\Common\Tests\Metadata\Driver;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use DoctrineExtensions\Common\Metadata\Driver\ExtensionDriver;
use DoctrineExtensions\Common\Metadata\Driver\AnnotationDriverExtensionInterface;
use DoctrineExtensions\Common\Metadata\ExtendedClassMetadata;
use DoctrineExtensions\Common\Tests\Fixture\Entity\Dummy;
use PHPUnit\Framework\TestCase;

class AnnotationDriverTest extends TestCase
{
    public function testAddExtension()
    {
        $reader = $this->createMock(AnnotationReader::class);
        $innerDriver = $this->createMock(AnnotationDriver::class);
        $driver = new ExtensionDriver($innerDriver, $reader);
        $extension = $this->createMock(AnnotationDriverExtensionInterface::class);

        $this->assertSame($driver, $driver->addExtension($extension));
    }

    public function testGetExtensions()
    {
        $reader = $this->createMock(AnnotationReader::class);
        $innerDriver = $this->createMock(AnnotationDriver::class);
        $driver = new ExtensionDriver($innerDriver, $reader);
        $extension = $this->createMock(AnnotationDriverExtensionInterface::class);

        $driver->addExtension($extension);

        $this->assertCount(1, $driver->getExtensions());
    }

    public function testLoadMetadataForClass()
    {
        $reader = new AnnotationReader();
        $innerDriver = $this->createMock(AnnotationDriver::class);
        $driver = new ExtensionDriver($innerDriver, $reader);

        $metadata = $this->createMock(ExtendedClassMetadata::class);
        $metadata->name = Dummy::class;
        $extension = $this->createMock(AnnotationDriverExtensionInterface::class);
        $extension->expects($this->once())->method('loadMetadataForClass');

        $driver->addExtension($extension);

        $driver->loadMetadataForClass(Dummy::class, $metadata);
    }
}
