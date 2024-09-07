<?php

include("../models/LinkModel.php");

function doGetLinks($conn, $userId)
{
    return json_encode(getLinks($conn, $userId));
}

function doGetLink($conn, $linkId)
{
    return json_encode(getLink($conn, $linkId));
}

function doAddLink($conn, $linkName, $linkAddress, $userId)
{
    return json_encode(addLink($conn, $linkName, $linkAddress, $userId));
}

function doEditLink($conn, $linkId, $linkName, $linkAddress)
{
    return json_encode(editLink($conn, $linkId, $linkName, $linkAddress));
}

function doDeleteLink($conn, $linkId)
{
    return json_encode(deleteLink($conn, $linkId));
}
