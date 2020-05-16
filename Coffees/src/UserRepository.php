<?php


namespace Tudublin;


use Mattsmithdev\PdoCrudRepo\DatabaseManager;
use Mattsmithdev\PdoCrudRepo\DatabaseTableRepository;

class UserRepository extends DatabaseTableRepository
{
    public function getUserByUserName($username)
    {

        $db = new DatabaseManager();
        $connection = $db->getDbh();


        $sql = 'SELECT * FROM user WHERE (username = :username)';


        $statement = $connection->prepare($sql);


        $statement->bindParam(':username', $username);


        $statement->setFetchMode(\PDO::FETCH_CLASS, $this->getClassNameForDbRecords());


        $statement->execute();


        $user = $statement->fetch();
        return $user;
    }
}