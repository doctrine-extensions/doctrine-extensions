<?php

namespace App\Metadata;

namespace DoctrineExtensions\Common\Metadata;

use Doctrine\ORM\Mapping\ClassMetadata;

class ExtendedClassMetadata extends ClassMetadata
{
    private $doctrineExtensions = [];

    public function addExtensionFieldMetadata(string $extension, ?string $field, $value)
    {
        if (!array_key_exists($extension, $this->doctrineExtensions)) {
            $this->doctrineExtensions[$extension] = [
                'fields' => [],
            ];
        }

        $this->doctrineExtensions[$extension]['fields'][$field] = $value;
    }

    public function getExtensionMetadata(string $extension)
    {
        return array_key_exists($extension, $this->doctrineExtensions) ? $this->doctrineExtensions[$extension] : null;
    }
}
