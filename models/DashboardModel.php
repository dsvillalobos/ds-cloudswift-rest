<?php

function getStorageInfo($conn, $userId)
{
    try {
        $filesQuery = "SELECT COUNT(FileID) AS Files FROM files_view WHERE UserID = :UserID LIMIT 1;";
        $filesStmt = $conn->prepare($filesQuery);
        $filesStmt->bindParam(":UserID", $userId);
        $filesStmt->execute();
        $files = $filesStmt->fetch(PDO::FETCH_ASSOC);

        $linksQuery = "SELECT COUNT(LinkID) AS Links FROM links_view WHERE UserID = :UserID LIMIT 1;";
        $linksStmt = $conn->prepare($linksQuery);
        $linksStmt->bindParam(":UserID", $userId);
        $linksStmt->execute();
        $links = $linksStmt->fetch(PDO::FETCH_ASSOC);

        $notesQuery = "SELECT COUNT(NoteID) AS Notes FROM notes_view WHERE UserID = :UserID LIMIT 1;";
        $notesStmt = $conn->prepare($notesQuery);
        $notesStmt->bindParam(":UserID", $userId);
        $notesStmt->execute();
        $notes = $notesStmt->fetch(PDO::FETCH_ASSOC);

        $storageInfo = [$files, $links, $notes];

        return $storageInfo;
    } catch (Exception $err) {
        return "Error: " . $err->getMessage();
    }
}

function getRecentActivityInfo($conn, $userId)
{
    try {
        $filesQuery = "SELECT FileID, FileName, Date, Time FROM files_view WHERE UserID = :UserID ORDER BY Date DESC, Time DESC LIMIT 1;";
        $filesStmt = $conn->prepare($filesQuery);
        $filesStmt->bindParam(":UserID", $userId);
        $filesStmt->execute();
        $files = $filesStmt->fetch(PDO::FETCH_ASSOC);

        $linksQuery = "SELECT LinkID, LinkName, Date, Time FROM links_view WHERE UserID = :UserID ORDER BY Date DESC, Time DESC LIMIT 1;";
        $linksStmt = $conn->prepare($linksQuery);
        $linksStmt->bindParam(":UserID", $userId);
        $linksStmt->execute();
        $links = $linksStmt->fetch(PDO::FETCH_ASSOC);

        $notesQuery = "SELECT NoteID, NoteTitle, Date, Time FROM notes_view WHERE UserID = :UserID ORDER BY Date DESC, Time DESC LIMIT 1;";
        $notesStmt = $conn->prepare($notesQuery);
        $notesStmt->bindParam(":UserID", $userId);
        $notesStmt->execute();
        $notes = $notesStmt->fetch(PDO::FETCH_ASSOC);

        $recentActivityInfo = [$files, $links, $notes];

        return $recentActivityInfo;
    } catch (Exception $err) {
        return "Error: " . $err->getMessage();
    }
}
