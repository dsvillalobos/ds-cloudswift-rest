<?php

function getNotes($conn, $userId)
{
    try {
        $query = "SELECT * FROM notes_view WHERE UserID = :UserID;";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":UserID", $userId);
        $stmt->execute();
        $notes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $notes;
    } catch (Exception $err) {
        return "Error: " . $err->getMessage();
    }
}

function getNote($conn, $noteId)
{
    try {
        $query = "SELECT * FROM notes WHERE NoteID = :NoteID LIMIT 1;";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":NoteID", $noteId);
        $stmt->execute();
        $note = $stmt->fetch(PDO::FETCH_ASSOC);

        return $note;
    } catch (Exception $err) {
        return "Error: " . $err->getMessage();
    }
}

function addNote($conn, $noteTitle, $noteBody, $userId)
{
    try {
        $query = "INSERT INTO notes (NoteTitle, NoteBody, UserID) VALUES (:NoteTitle, :NoteBody, :UserID);";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":NoteTitle", $noteTitle);
        $stmt->bindParam(":NoteBody", $noteBody);
        $stmt->bindParam(":UserID", $userId);
        $stmt->execute();

        return "Success: Note added successfully";
    } catch (Exception $err) {
        return "Error: " . $err->getMessage();
    }
}

function editNote($conn, $noteId, $noteTitle, $noteBody)
{
    try {
        $query = "UPDATE notes SET NoteTitle = :NoteTitle, NoteBody = :NoteBody WHERE NoteID = :NoteID;";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":NoteTitle", $noteTitle);
        $stmt->bindParam(":NoteBody", $noteBody);
        $stmt->bindParam(":NoteID", $noteId);
        $stmt->execute();

        return "Success: Note edited successfully";
    } catch (Exception $err) {
        return "Error: " . $err->getMessage();
    }
}

function deleteNote($conn, $noteId)
{
    try {
        $query = "DELETE FROM notes WHERE NoteID = :NoteID;";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":NoteID", $noteId);
        $stmt->execute();

        return "Success: Note deleted successfully";
    } catch (Exception $err) {
        return "Error: " . $err->getMessage();
    }
}
