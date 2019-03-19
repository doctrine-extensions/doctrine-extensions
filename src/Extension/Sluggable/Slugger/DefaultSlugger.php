<?php

namespace DoctrineExtensions\Extension\Sluggable\Slugger;

use Behat\Transliterator\Transliterator;
use Symfony\Component\PropertyAccess\PropertyAccess;

class DefaultSlugger implements SluggerInterface
{
    public function __invoke(object $entity, array $fields, string $separator, ?string $glue = null): string
    {
        if ($glue === null) {
            $glue = $separator;
        }

        $parts = [];
        $accessor = PropertyAccess::createPropertyAccessor();

        foreach ($fields as $field) {
            if ($accessor->isReadable($entity, $field)) {
                $parts[] = Transliterator::transliterate($accessor->getValue($entity, $field), $separator);
            } else {
                // exception
            }
        }

        return implode($glue, $parts);
    }
}
