<?php

class QueryBilder
{
    public function getComments ($pdo)
    {
        $sql = "SELECT * FROM comments";
        $statement  = $pdo->query($sql);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}