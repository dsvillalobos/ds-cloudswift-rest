<?php

function getFiles($conn, $userId)
{
    try {
        $query = "SELECT FileID, FileName, FileType, MimeType, Date, Time, UserID, Name, LastName, Email FROM files_view WHERE UserID = :UserID;";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":UserID", $userId);
        $stmt->execute();
        $files = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $files;
    } catch (Exception $err) {
        return "Error: " . $err->getMessage();
    }
}

function downloadFile($conn, $fileId)
{
    try {
        $query = "SELECT * FROM files WHERE FileID = :FileID LIMIT 1;";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":FileID", $fileId);
        $stmt->execute();
        $file = $stmt->fetch(PDO::FETCH_ASSOC);
        header("Content-Description: File Transfer");
        header("Content-Type: " . $file["MimeType"]);
        header("Content-Disposition: attachment; filename='" . $file["FileName"] . "." . $file["FileType"] . "'");
        header("Expires: 0");
        header("Cache-Control: must-revalidate");
        header("Pragma: public");

        echo $file["FileData"];
    } catch (Exception $err) {
        return "Error: " . $err->getMessage();
    }
}

function addFile($conn, $fileName, $fileType, $mimeType, $fileData, $userId)
{
    try {
        $query = "INSERT INTO files (FileName, FileType, MimeType, FileData, UserID) VALUES (:FileName, :FileType, :MimeType, :FileData, :UserID);";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":FileName", $fileName);
        $stmt->bindParam(":FileType", $fileType);
        $stmt->bindParam(":MimeType", $mimeType);
        $stmt->bindParam(":FileData", $fileData);
        $stmt->bindParam(":UserID", $userId);
        $stmt->execute();

        return "Success: File added successfully";
    } catch (Exception $err) {
        return "Error: " . $err->getMessage();
    }
}

function deleteFile($conn, $fileId)
{
    try {
        $query = "DELETE FROM files WHERE FileID = :FileID;";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":FileID", $fileId);
        $stmt->execute();

        return "Success: File deleted successfully";
    } catch (Exception $err) {
        return "Error: " . $err->getMessage();
    }
}
