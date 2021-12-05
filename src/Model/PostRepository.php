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

    /**
     * Retourne tous les posts
     *
     * @return array
     */
    public function findAllPosts()
    {
        $query = $this->pdo->prepare("SELECT ".Post::TABLE_NAME.".*, count(".UserLikePost::TABLE_NAME.".id_user) as nbLikes from ".Post::TABLE_NAME." left join ".UserLikePost::TABLE_NAME." ON ".UserLikePost::TABLE_NAME.".id_post = ".Post::TABLE_NAME.".id GROUP BY ".Post::TABLE_NAME.".id ORDER BY created_at DESC LIMIT 25");
        $query->execute();
        
        //FAIRE l'HYDRATATION
        return parent::hydrate($query->fetchAll(PDO::FETCH_CLASS),new Post(),[['created_by',new User]]);
    }


    /**
     * Créer un nouveau post
     *
     * @param int $iduser
     * @param string $comment
     * @return void
     */
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


    /**
     * Retourne null ou un UserLikePost entity
     *
     * @param int $iduser
     * @param int $idpost
     * @return NULL|UserLikePost
     */
    public function hasUserLikedPost($iduser,$idpost)
    {
        $query = $this->pdo->prepare("SELECT * FROM ".UserLikePost::TABLE_NAME." WHERE id_user = :id_user AND id_post =:id_post");
        $query->bindParam(':id_user', $iduser);
        $query->bindParam(':id_post', $idpost);
        $query->execute();
        
        //FAIRE l'HYDRATATION
        return parent::hydrate($query->fetchAll(PDO::FETCH_CLASS),new UserLikePost());
    }


    /**
     * Liker un post
     *
     * @param int $id_user
     * @param int $id_post
     * @return void
     */
    public function likePost($id_user,$id_post)
    {
        $stmt = $this->pdo->prepare("INSERT INTO ".UserLikePost::TABLE_NAME." (id_user, id_post) VALUES (:id_user, :id_post)");
        $stmt->bindParam(':id_user', $id_user);
        $stmt->bindParam(':id_post', $id_post);
        $stmt->execute();
    }


    /**
     * Supprimer un like d'un post
     *
     * @param int $id_user
     * @param int $id_post
     * @return void
     */
    public function deleteLikePost($id_user,$id_post)
    {
        $stmt = $this->pdo->prepare("DELETE FROM ".UserLikePost::TABLE_NAME." WHERE id_user = :id_user AND id_post = :id_post");
        $stmt->bindParam(':id_user', $id_user);
        $stmt->bindParam(':id_post', $id_post);
        $stmt->execute();
    }



    /**
     * Retourne un seul post
     *
     * @param int $id_post
     * @return Post
     */
    public function getSinglePost($id_post)
    {
        $query = $this->pdo->prepare("SELECT ".Post::TABLE_NAME.".*, count(".UserLikePost::TABLE_NAME.".id_user) as nbLikes from ".Post::TABLE_NAME." left join ".UserLikePost::TABLE_NAME." ON ".UserLikePost::TABLE_NAME.".id_post = ".Post::TABLE_NAME.".id WHERE id =:id_post GROUP BY ".Post::TABLE_NAME.".id");
        $query->bindParam(':id_post', $id_post);
        $query->execute();
        //FAIRE l'HYDRATATION et si on a bien un résultat on le return autrement on retourne null
        $post = parent::hydrate($query->fetchAll(PDO::FETCH_CLASS),new Post());
        return !empty($post) ? $post[0] : null;
    }


    /**
     * Retourne le dernier ID inserted 
     *
     * @return int
     */
    public function getLastInsertedId()
    {
        $query = $this->pdo->prepare("SELECT MAX(id) FROM ".Post::TABLE_NAME."");
        $query->execute();
        return $query->fetchAll()[0][0];
    }

    /**
     * Delete a post
     *
     * @return void
     */
    public function deletePost($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM ".Post::TABLE_NAME." WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}


