<?php

include("../models/FileModel.php");

function doGetFiles($conn, $userId)
{
    return json_encode(getFiles($conn, $userId));
}

function doDownloadFile($conn, $fileId)
{
    return json_encode(downloadFile($conn, $fileId));
}

function doAddFile($conn, $fileName, $fileType, $mimeType, $fileData, $userId)
{
    return json_encode(addFile($conn, $fileName, $fileType, $mimeType, $fileData, $userId));
}

function doDeleteFile($conn, $fileId)
{
    return json_encode(deleteFile($conn, $fileId));
}
