<?php

namespace DoctrineExtensions\Extension\Sluggable\Slugger;

interface SluggerInterface
{
    public function __invoke(object $entity, array $fields, string $separator, ?string $glue = null): string;
}
