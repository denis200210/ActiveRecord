<?php

$connection = new PDO("sqlite:dbname=mysql;host=localhost", "denis200210", "");

class book{
    private $id;
    private $name_b;
    private $author;

    public function __construct($id, $name_b, $author) {
        $this->id = $id;
        $this->name_b = $name_b;
        $this->author=$author;
    }

    public function save($connection){
                
        $sql = $connection->prepare("Inser into book (id, name_b, author) VALUES (?,?,?);");
        $data = array ($this->id,$this->name_b,$this->author);
        $sql->execute($data);  
    }

    public function remove($connection){

        $sql = $connection->prepare("Delete from book where id=?,author=? ");
        $data = array ($this->id,$this->name_b,$this->author);
        $sql->execute($data);  
    }

    public function getById($connection,$id): book{
       
        $sql = $connection->prepare("Select * from book where id = ? ");
        $sql->execute();
        $row = $sql->fetch(\PDO::FETCH_ASSOC);
        return new book($row['id'],$row['name_b'],$row['author']);
    }

    public function all($connection): array {
        
        $sql = $connection->prepare("Select * from book");
        $sql->execute();
        $rows = $sql->fetchAll();
        return $rows;
    }

    public function getByAuthor($connection,$author): array {
        
        $sql = $connection->prepare("Select * from book where author = ? ");
        $sql->execute();
        $rows = $sql->fetchAll();
        return $rows;
    }    
}
?>