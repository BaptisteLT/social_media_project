<?php
namespace App\model;
use PDO;
use App\Entity\Post;
use App\Entity\User;
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
        
        //dd($query->fetchAll(PDO::FETCH_CLASS));die;
        
        //FAIRE l'HYDRATATION
        return parent::hydrate($query->fetchAll(PDO::FETCH_CLASS),new Post(),[['created_by',new User]]);
    }
}