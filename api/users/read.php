<?php
// необходимые HTTP-заголовки 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// подключение базы данных и файл, содержащий объекты 
include_once '../database.php';
include_once '../objects/users.php';


$database = new Database();
$db = $database->getConnection();

// инициализируем объект 
$users = new Users($db);
 

$stmt = $users->read();
$num = $stmt->rowCount();


if ($num>0) {

    $users_arr=array();
    $users_arr["users"]=array();

    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        // извлекаем строку 
        extract($row);

        $users_item=array(
            "id" => $id,
            'Полное_имя' => $Полное_имя,
            "Логин" => html_entity_decode($Логин),
            "Роли" => $Роли,
            "Активность" => $Активность,
            
        );

        array_push($users_arr["users"], $users_item);
    }

    // устанавливаем код ответа - 200 OK 
    http_response_code(200);

    // выводим данные о товаре в формате JSON 
    echo json_encode($users_arr);
}
else {

    // установим код ответа - 404 Не найдено 
    http_response_code(404);

    
    echo json_encode(array("message" => "Пользователи не найдены."), JSON_UNESCAPED_UNICODE);
}
?>