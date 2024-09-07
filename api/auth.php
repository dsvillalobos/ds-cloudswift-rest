<?php

include("../config/connection.php");
include("../controllers/AuthController.php");

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

$requestMethod = $_SERVER["REQUEST_METHOD"];
$id = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";

switch ($requestMethod) {
    case "GET":
        break;
    case "POST":
        $data = json_decode(file_get_contents("php://input"));

        if ($id == "sign-in") {
            echo doSignIn($conn, $data->email, $data->password);
        } else if ($id == "sign-up") {
            echo doSignUp($conn, $data->name, $data->lastName, $data->email, $data->password);
        } else {
            echo "Error: Invalid ID";
        }
        break;
    case "PUT":
        break;
    case "DELETE":
        break;
    default:
        echo "Error: Invalid HTTP Request Method";
}
