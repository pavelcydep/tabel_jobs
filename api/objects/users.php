<?php
class Users {

   
    private $conn;
    private $table_name = "user_jobs";

 

    // конструктор для соединения с базой данных 
    public function __construct($db){
        $this->conn = $db;
    }

    function read(){

        // выбираем все записи 
        $query = "SELECT * FROM `user_jobs` ";
       
        
        // подготовка запроса 
        $stmt = $this->conn->prepare($query);
        
        // выполняем запрос 
        $stmt->execute();
        
        return $stmt;
        }
}
?>