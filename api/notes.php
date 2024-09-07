<?php

include("../config/connection.php");
include("../controllers/NoteController.php");

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

$requestMethod = $_SERVER["REQUEST_METHOD"];
$id = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";

switch ($requestMethod) {
    case "GET":
        $arr = explode("/", $id);

        if ($arr[0] == "get-notes") {
            $userId = $arr[1];
            echo doGetNotes($conn, $userId);
        } else if ($arr[0] == "get-note") {
            $noteId = $arr[1];
            echo doGetNote($conn, $noteId);
        } else {
            echo "Error: Invalid ID";
        }
        break;
    case "POST":
        $data = json_decode(file_get_contents("php://input"));
        echo doAddNote($conn, $data->noteTitle, $data->noteBody, $data->userId);
        break;
    case "PUT":
        $data = json_decode(file_get_contents("php://input"));
        echo doEditNote($conn, $data->noteId, $data->noteTitle, $data->noteBody);
        break;
    case "DELETE":
        echo doDeleteNote($conn, $id);
        break;
    default:
        echo "Error: Invalid HTTP Request Method";
}
