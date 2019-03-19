<?php

namespace DoctrineExtensions\Extension\Sluggable\Annotation;

use Behat\Transliterator\Transliterator;
use DoctrineExtensions\Extension\Sluggable\Slugger\DefaultSlugger;
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
     * The separator character is used to replace spaces
     *
     * @var string
     */
    public $separator = '-';

    /**
     * The glue is used to concat different fields. If left as null, it will fall back to the separator
     *
     * @var string
     */
    public $glue;

    /**
     * A valid callable or an FQCN of an invokable class.
     *
     * @var mixed
     */
    public $callback = DefaultSlugger::class;
}
