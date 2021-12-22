<?php
class Tasks {

   
    private $conn;
    private $table_name = "tasks";

    
   

    // конструктор для соединения с базой данных 
    public function __construct($db){
        $this->conn = $db;
    }

    function read(){

        // выбираем все записи 
        $query = "SELECT * FROM `tasks` ";
       
        
        // подготовка запроса 
        $stmt = $this->conn->prepare($query);
        
        // выполняем запрос 
        $stmt->execute();
        
        return $stmt;
        }
}
?>