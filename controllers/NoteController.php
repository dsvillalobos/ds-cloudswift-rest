<?php

include("../models/NoteModel.php");

function doGetNotes($conn, $userId)
{
    return json_encode(getNotes($conn, $userId));
}

function doGetNote($conn, $noteId)
{
    return json_encode(getNote($conn, $noteId));
}

function doAddNote($conn, $noteTitle, $noteBody, $userId)
{
    return json_encode(addNote($conn, $noteTitle, $noteBody, $userId));
}

function doEditNote($conn, $noteId, $noteTitle, $noteBody)
{
    return json_encode(editNote($conn, $noteId, $noteTitle, $noteBody));
}

function doDeleteNote($conn, $noteId)
{
    return json_encode(deleteNote($conn, $noteId));
}
