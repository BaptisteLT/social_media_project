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

    public function createUser($hashedPassword, $username)
    {
        $stmt = $this->pdo->prepare("INSERT INTO utilisateur (username, password) VALUES (:username, :password)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->execute();
    }
}