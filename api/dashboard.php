<?php

include("../config/connection.php");
include("../controllers/DashboardController.php");

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

$requestMethod = $_SERVER["REQUEST_METHOD"];
$id = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";

switch ($requestMethod) {
    case "GET":
        $arr = explode("/", $id);

        if ($arr[0] == "get-storage-info") {
            $userId = $arr[1];
            echo doGetStorageInfo($conn, $userId);
        } else if ($arr[0] == "get-recent-activity-info") {
            $userId = $arr[1];
            echo doGetRecentActivityInfo($conn, $userId);
        } else {
            echo "Error: Invalid ID";
        }
        break;
    case "POST":
        break;
    case "PUT":
        break;
    case "DELETE":
        break;
    default:
        echo "Error: Invalid HTTP Request Method";
}
