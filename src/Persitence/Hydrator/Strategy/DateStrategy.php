<?php

namespace App\Persitence\Hydrator\Strategy;

use DateTime;
use Laminas\Hydrator\Strategy\DefaultStrategy;

class DateStrategy extends DefaultStrategy
{

    public function hydrate($value, ?array $data = null)
    {

        if (is_string($value)) {
            $value = new DateTime($value);

        }
        return $value;
    }

    public function extract($value, ?object $object = null)
    {
        if ($value instanceof DateTime) {
            $value->format('Y-m-d');
        }
        return $value;
    }
}