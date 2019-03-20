<?php

namespace DoctrineExtensions\Common\Exception;

class UndefinedPropertyException extends \Exception
{
    public function __construct(object $entity, string $field)
    {
        parent::__construct(
            sprintf(
                'The "%s" entity does not have a property named "%s", or it is inaccessible. Did you add the necessary getters?',
                get_class($entity),
                $field
            )
        );
    }
}
