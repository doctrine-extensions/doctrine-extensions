<?php

namespace DoctrineExtensions\Extension\Sluggable\Annotation;

use Behat\Transliterator\Transliterator;
use Symfony\Component\PropertyAccess\PropertyAccess;

/**
 * @Annotation
 * @Target({"PROPERTY"})
 */
class Sluggable
{
    /**
     * @var array
     */
    public $fields = [];

    /**
     * @var string
     */
    public $separator = '-';

    /**
     * @var callable
     */
    public $callback;

    public function __construct()
    {
        $this->callback = function ($entity, $fields, $separator) {
            $parts = [];
            $accessor = PropertyAccess::createPropertyAccessor();

            foreach ($fields as $field) {
                if ($accessor->isReadable($entity, $field)) {
                    $parts[] = $accessor->getValue($entity, $field);
                } else {
                    // exception
                }
            }

            return Transliterator::transliterate(implode($separator, $parts), $separator);
        };
    }
}
