<?php

include("../config/connection.php");
include("../controllers/FileController.php");

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

$requestMethod = $_SERVER["REQUEST_METHOD"];
$id = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";

switch ($requestMethod) {
    case "GET":
        $arr = explode("/", $id);

        if ($arr[0] == "get-files") {
            $userId = $arr[1];
            echo doGetFiles($conn, $userId);
        } else if ($arr[0] == "download-file") {
            $fileId = $arr[1];
            echo doDownloadFile($conn, $fileId);
        } else {
            echo "Error: Invalid ID";
        }
        break;
    case "POST":
        if (isset($_FILES["file"])) {
            $fileName = $_POST["fileName"];
            $arr = explode(".", $_FILES["file"]["name"]);
            $fileType = $arr[1];
            $mimeType = $_FILES["file"]["type"];
            $fileData = file_get_contents($_FILES["file"]["tmp_name"]);
            $userId = $_POST["userId"];

            echo doAddFile($conn, $fileName, $fileType, $mimeType, $fileData, $userId);
        } else {
            echo "Error: No File Selected";
        }
        break;
    case "PUT":
        break;
    case "DELETE":
        echo doDeleteFile($conn, $id);
        break;
    default:
        echo "Error: Invalid HTTP Request Method";
}
