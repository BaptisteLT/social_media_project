<?php
namespace App\model;

use PDO;
use App\DatabaseConnect\PDOSingleton;

class ParentRepository
{

    /**
     * Prend en paramètre un array de données d'entités PDO
     * ainsi que la classe correspondante (cette entity doit avoir une 
     * constante TABLE_NAME avec le nom de la table correspondante en BDD)
     * et retourne les entités hydratées sous forme d'un array
     *
     * @param array $data
     * @param class $entity
     * @return array
     */
    protected function hydrate($data, $entity, $fieldsToHydrate=[])
    {
       //Elements à retourner
       $hydratedElements = [];

        if(!empty($data))
        {
            foreach($data as $class)
            {
                /*Pour le futur, vérifier à bien créer une nouvelle entité sinon ça écrase toutes les précédentes qui sont push dans l'array*/
                $newEntity = new $entity;
                foreach ($class as $attribut => $value) {
                    //Ajoute les setters automatiquement en fonctionne du nom du champ en BDD
                    $method = 'set'.str_replace(' ', '', ucwords(str_replace('_', ' ', $attribut)));
                    
                    //Pour chaque field à hydrate avec une entité
                    foreach($fieldsToHydrate as $fieldToHydrate)
                    {
                        //Si l'attribut correspond on le met à jour avec l'id
                        if($fieldToHydrate[0] == $attribut)
                        {   
                            /*Pour le futur, vérifier à bien créer une nouvelle entité sinon ça écrase toutes les précédentes qui sont push dans l'array*/
                            $fieldClass = new $fieldToHydrate[1];

                            $pdo = PDOSingleton::getInstance();
                            $pdo = $pdo->getConnection();
                            $query = $pdo->prepare("SELECT * FROM ".$fieldToHydrate[1]::TABLE_NAME." WHERE id = :id");
                            $query->bindParam(':id', $value, PDO::PARAM_INT);
                            $query->execute();
                            $pdoEntity = $query->fetchAll(PDO::FETCH_CLASS);
                            if($pdoEntity != null)
                            {
                                $pdoEntity = $pdoEntity[0];
                            }
                            foreach($pdoEntity as $attribut => $value)
                            {
                                $methodPdoEntity = 'set'.str_replace(' ', '', ucwords(str_replace('_', ' ', $attribut)));
                                if (is_callable(array($fieldClass, $methodPdoEntity))) {
                                    //Si c'est un string alors on met htmlspecialchars, autrement on met la valeur normale qui sera integer, bool, etc.
                                    $fieldClass->$methodPdoEntity(is_string($value) ? htmlspecialchars($value) : $value);
                                }
                            }
                            //La nouvelle valeur
                            $value=$fieldClass;
                        }
                    }
                    //if($attribut);

                    if (is_callable(array($newEntity, $method))) {
                        //Si c'est un string alors on met htmlspecialchars, autrement on met la valeur normale qui sera integer, bool, etc.
                        $newEntity->$method(is_string($value) ? htmlspecialchars($value) : $value);
                    }
                    else
                    {
                        //var_dump($newEntity);
                        var_dump($method);
                        var_dump($attribut);
                        var_dump($value);
                        die('Problème dans la convertion du setter. (Vérifier entité)');
                    }
                }
                //trouver pourquoi ça rempalce le hydradelements
                $hydratedElements[] = $newEntity;
                
            }
        }
        else
        {
            return [];
        }
        return $hydratedElements;
    }


}