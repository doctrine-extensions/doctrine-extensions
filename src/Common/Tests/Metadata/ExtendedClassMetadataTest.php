<?php

namespace DoctrineExtensions\Common\Tests\Metadata;

use DoctrineExtensions\Common\Metadata\ExtendedClassMetadata;
use DoctrineExtensions\Common\Tests\Fixture\Entity\Dummy;
use PHPUnit\Framework\TestCase;

class ExtendedClassMetadataTest extends TestCase
{
    public function testAddExtensionFieldMetadata()
    {
        $metadata = new ExtendedClassMetadata(Dummy::class);

        $this->assertNull($metadata->addExtensionFieldMetadata('SomeExtension', 'someField', 'someValue'));
    }

    public function testGetExtensionMetadata()
    {
        $metadata = new ExtendedClassMetadata(Dummy::class);

        $metadata->addExtensionFieldMetadata('SomeExtension', 'someField', 'someValue');

        $this->assertEquals(
            [
                'fields' => [
                    'someField' => 'someValue',
                ]
            ],
            $metadata->getExtensionMetadata('SomeExtension')
        );
        $this->assertNull($metadata->getExtensionMetadata('SomeOtherExtension'));
    }
}
