<?php
namespace App\model;
use App\Model\ParentRepository;
use App\DatabaseConnect\PDOSingleton;

class PostRepository extends ParentRepository{

    private $pdo;

    public function __construct()
    {
        $pdo = PDOSingleton::getInstance();
        $this->pdo=$pdo->getConnection();
    }

    public function findAllPosts()
    {
        $query = $this->pdo->prepare("SELECT * FROM post");
        //$query->bindValue('pseudo', $pseudo, PDO::PARAM_STR);
        $query->execute();
        
        //FAIRE l'HYDRATATION
        return parent::hydrate($query->fetch(),'entity');
    }
}