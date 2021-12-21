<?php
class Users {

    // подключение к базе данных и таблице 'products' 
    private $conn;
    private $table_name = "user_jobs";

    // свойства объекта 
    public $id;
    public $Полное_имя;
    public $Логин;
    public $Роли;
    public $Активность;
 

    // конструктор для соединения с базой данных 
    public function __construct($db){
        $this->conn = $db;
    }

    function read(){

        // выбираем все записи 
        $query = "SELECT * FROM " . $this->table_name ."";
       
        
        // подготовка запроса 
        $stmt = $this->conn->prepare($query);
        
        // выполняем запрос 
        $stmt->execute();
        
        return $stmt;
        }
}
?>