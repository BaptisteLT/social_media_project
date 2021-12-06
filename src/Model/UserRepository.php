<?php
namespace App\model;
use PDO;
use App\Entity\User;
use App\Model\ParentRepository;
use App\DatabaseConnect\PDOSingleton;

class UserRepository extends ParentRepository{

    private $pdo;

    public function __construct()
    {
        $pdo = PDOSingleton::getInstance();
        $this->pdo=$pdo->getConnection();
    }

    public function verifyUserExists($username)
    {
        $query = $this->pdo->prepare("SELECT * FROM ".User::TABLE_NAME." WHERE username = :username");
        $query->bindParam(':username', $username);
        $query->execute();
        $pdoEntity = $query->fetch();
        return $pdoEntity;
    }

    /*Retourne un utilisateur avec son attribut username*/
    public function getUser($username)
    {
        $query = $this->pdo->prepare("SELECT * FROM ".User::TABLE_NAME." where username = :username");
        $query->bindValue(':username', $username, PDO::PARAM_STR);
        $query->execute();

        //FAIRE l'HYDRATATION
        return parent::hydrate($query->fetchAll(PDO::FETCH_CLASS),new User());
    }

    public function createUser($hashedPassword, $username)
    {
        $stmt = $this->pdo->prepare("INSERT INTO ".User::TABLE_NAME." (username, password) VALUES (:username, :password)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->execute();
    }

    public function editUserPassword($hashedPassword, $userid)
    {
        $stmt = $this->pdo->prepare("UPDATE ".User::TABLE_NAME." SET password = :password WHERE id = :userid");
        $stmt->bindParam(':userid', $userid);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->execute();
    }
}