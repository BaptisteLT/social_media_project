<?php
namespace App\model;

use App\DatabaseConnect\PDOSingleton;

class ParentRepository
{
    protected function hydrate($data,$entity)
    {

        foreach ($data as $attribut => $value) {
            $method = 'set'.str_replace(' ', '', ucwords(str_replace('_', ' ', $attribut)));
            if (is_callable(array($entity, $method))) {
                $entity->$method($value);
            }
        }
    }


}