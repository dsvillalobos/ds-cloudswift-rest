<?php

function getLinks($conn, $userId)
{
    try {
        $query = "SELECT * FROM links_view WHERE UserID = :UserID;";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":UserID", $userId);
        $stmt->execute();
        $links = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $links;
    } catch (Exception $err) {
        return "Error: " . $err->getMessage();
    }
}

function getLink($conn, $linkId)
{
    try {
        $query = "SELECT * FROM links WHERE LinkID = :LinkID LIMIT 1;";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":LinkID", $linkId);
        $stmt->execute();
        $link = $stmt->fetch(PDO::FETCH_ASSOC);

        return $link;
    } catch (Exception $err) {
        return "Error: " . $err->getMessage();
    }
}

function addLink($conn, $linkName, $linkAddress, $userId)
{
    try {
        $query = "INSERT INTO links (LinkName, LinkAddress, UserID) VALUES (:LinkName, :LinkAddress, :UserID);";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":LinkName", $linkName);
        $stmt->bindParam(":LinkAddress", $linkAddress);
        $stmt->bindParam(":UserID", $userId);
        $stmt->execute();

        return "Success: Link added successfully";
    } catch (Exception $err) {
        return "Error: " . $err->getMessage();
    }
}

function editLink($conn, $linkId, $linkName, $linkAddress)
{
    try {
        $query = "UPDATE links SET LinkName = :LinkName, LinkAddress = :LinkAddress WHERE LinkID = :LinkID;";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":LinkName", $linkName);
        $stmt->bindParam(":LinkAddress", $linkAddress);
        $stmt->bindParam(":LinkID", $linkId);
        $stmt->execute();

        return "Success: Link edited successfully";
    } catch (Exception $err) {
        return "Error: " . $err->getMessage();
    }
}

function deleteLink($conn, $linkId)
{
    try {
        $query = "DELETE FROM links WHERE LinkID = :LinkID;";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":LinkID", $linkId);
        $stmt->execute();

        return "Success: Link deleted successfully";
    } catch (Exception $err) {
        return "Error: " . $err->getMessage();
    }
}
