<?php

namespace DoctrineExtensions\Extension\Timestampable\Annotation;

/**
 * @Annotation
 * @Target({"PROPERTY"})
 */
class Timestampable
{
    /**
     * @var bool
     */
    public $onPersist = false;

    /**
     * @var bool
     */
    public $onUpdate = false;
}
