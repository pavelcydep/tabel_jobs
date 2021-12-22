<?php
// необходимые HTTP-заголовки 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// подключение базы данных и файл, содержащий объекты 
include_once '../database.php';

include_once '../objects/tasks.php';

$database = new Database();
$db = $database->getConnection();

// инициализируем объект 

$tasks = new Tasks($db);
 $stmt = $tasks->read();

$num = $stmt->rowCount();


if ($num>0) {

   
    $tasks_arr=array();
    
   $tasks_arr["tasks"]=array();
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        // извлекаем строку 
        extract($row);

        
        $tasks_item=array(
            "id" => $id,
            "Наименование_задачи" => $Наименование_задачи,
           "id_пользователя" => $id_пользователя,
           "Время_выделенное_на_выполнение_задачи_в_часах"=> $Время_выделенное_на_выполнение_задачи_в_часах,
           "Время_затраченное_на_выполнение_задачи_в_часах"=>$Время_затраченное_на_выполнение_задачи_в_часах,
           "Дата_и_время_старта_задачи"=>$Дата_и_время_старта_задачи,
        );
        
        array_push($tasks_arr["tasks"], $tasks_item);
     
        
    }

    // устанавливаем код ответа - 200 OK 
    http_response_code(200);

    // выводим данные о товаре в формате JSON 
    echo json_encode($tasks_arr);
}
else {

    // установим код ответа - 404 Не найдено 
    http_response_code(404);

    
    echo json_encode(array("message" => "Пользователи не найдены."), JSON_UNESCAPED_UNICODE);
}
?>