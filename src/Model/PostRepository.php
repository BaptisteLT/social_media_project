<?php
namespace App\model;
use PDO;
use App\Entity\Post;
use App\Entity\User;
use App\Entity\UserLikePost;
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
        $query = $this->pdo->prepare("SELECT ".Post::TABLE_NAME.".*, count(".UserLikePost::TABLE_NAME.".id_user) as nbLikes from ".Post::TABLE_NAME." left join ".UserLikePost::TABLE_NAME." ON ".UserLikePost::TABLE_NAME.".id_post = ".Post::TABLE_NAME.".id GROUP BY ".Post::TABLE_NAME.".id");
        $query->execute();
        
        //FAIRE l'HYDRATATION
        return parent::hydrate($query->fetchAll(PDO::FETCH_CLASS),new Post(),[['created_by',new User]]);
    }


    public function createNewPost($iduser,$comment)
    {
        $date_actuelle = date_create()->format('Y-m-d H:i:s');

        $stmt = $this->pdo->prepare("INSERT INTO post (comment, created_by, created_at, updated_at) VALUES (:comment, :iduser, :created_at, :updated_at)");
        $stmt->bindParam(':comment', $comment);
        $stmt->bindParam(':iduser', $iduser);
        $stmt->bindParam(':created_at', $date_actuelle);
        $stmt->bindParam(':updated_at', $date_actuelle);
        $stmt->execute();
    }


    public function hasUserLikedPost($iduser,$idpost)
    {
        $query = $this->pdo->prepare("SELECT * FROM ".UserLikePost::TABLE_NAME." WHERE id_user = :id_user AND id_post =:id_post");
        $query->bindParam(':id_user', $iduser);
        $query->bindParam(':id_post', $idpost);
        $query->execute();
        
        //FAIRE l'HYDRATATION
        return parent::hydrate($query->fetchAll(PDO::FETCH_CLASS),new UserLikePost());
    }

}

