<?php
require 'DataBase.php';

class QueryBilder extends DataBase
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = $this->dbConnect();
    }

    public function giveUserData ($user_id, $field_name)
    {
        $sql = "SELECT `".$field_name."` FROM `users` WHERE `id`=:user_id";
        $statement = $this->pdo->prepare($sql);
        $result = $statement->execute(array(
            ':user_id' => $user_id,
        ));
        if (!$result)
        {
            echo 'Ошибка запроса';
            die;
        }
        $data = $statement->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function editPassword ($user_id, $password)
    {
        $sql = "UPDATE `users` SET `password`=:password WHERE `id`=:user_id";
        $statement = $this->pdo->prepare($sql);
        $result = $statement->execute(array(
            ':user_id' => $user_id,
            ':password' => $password,
        ));
        return $result;
    }

    public function addUser ($user_name, $email, $password, $image = '')
    {
        $sql = "INSERT INTO `users`(`name`, `email`, `password`, `image`) VALUES (:user_name, :email, :password, :image)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':user_name' => $user_name,
            ':email'    => $email,
            ':password'=> $password,
            ':image'=> $image,
        ));
    }

    public function editProfile ($user_id, $user_name, $email, $image = '')
    {
        $sql = "UPDATE `users` SET `name`=:user_name,`email`=:email,`image`=:image WHERE `id`=:user_id";
        $statement = $this->pdo->prepare($sql);
        $result = $statement->execute(array(
            ':user_id' => $user_id,
            ':user_name' => $user_name,
            ':email'    => $email,
            ':image'=> $image,
        ));
        return $result;
    }

    public function checkDublicateEmail ($email)
    {
        $sql = "SELECT `email` FROM `users` WHERE `email` = :email";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':email' => $email,
        ));
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result['email'];
    }

    public function userVerification ($email)
    {
        $sql = "SELECT `id`, `name`, `password` FROM `users` WHERE `email` = :email";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':email' => $email,
        ));
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function addComment ($user_name, $avatar, $date, $message)
    {
        $sql = "INSERT INTO `comments`(`user_name`, `avatar`, `date`, `message`, `state`) VALUES (:user_name, :avatar, :today_date, :message, 1)";
        $statement = $this->pdo->prepare($sql);
        $result = $statement->execute(array(
            ':user_name' => $user_name,
            ':avatar'    => $avatar,
            ':today_date'=> $date,
            ':message'   => $message,
        ));
        return $result;
    }

    public function getComments ($all = true)
    {
        $sql = "SELECT * FROM comments WHERE `state`=1 ORDER BY `id` DESC";
        if ($all)
        {
            $sql = "SELECT * FROM comments ORDER BY `id` DESC";
        }
        $statement = $this->pdo->query($sql);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function editState ($comment_id, $state)
    {
        $sql = "UPDATE `comments` SET `state`=:state WHERE `id`=:comment_id";
        $statement = $this->pdo->prepare($sql);
        $result = $statement->execute(array(
            ':comment_id' => $comment_id,
            ':state' => $state,
        ));
        return $result;
    }

    public function deleteComment ($comment_id)
    {
        $sql = "DELETE FROM `comments` WHERE `id`=:comment_id";
        $statement = $this->pdo->prepare($sql);
        $result = $statement->execute(array(
            ':comment_id' => $comment_id,
        ));
        return $result;
    }
}
