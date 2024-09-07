<?php

include("../config/connection.php");
include("../controllers/LinkController.php");

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

$requestMethod = $_SERVER["REQUEST_METHOD"];
$id = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";

switch ($requestMethod) {
    case "GET":
        $arr = explode("/", $id);

        if ($arr[0] == "get-links") {
            $userId = $arr[1];
            echo doGetLinks($conn, $userId);
        } else if ($arr[0] == "get-link") {
            $linkId = $arr[1];
            echo doGetLink($conn, $linkId);
        } else {
            echo "Error: Invalid ID";
        }
        break;
    case "POST":
        $data = json_decode(file_get_contents("php://input"));
        echo doAddLink($conn, $data->linkName, $data->linkAddress, $data->userId);
        break;
    case "PUT":
        $data = json_decode(file_get_contents("php://input"));
        echo doEditLink($conn, $data->linkId, $data->linkName, $data->linkAddress);
        break;
    case "DELETE":
        echo doDeleteLink($conn, $id);
        break;
    default:
        echo "Error: Invalid HTTP Request Method";
}
