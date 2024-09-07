<?php

include("../models/DashboardModel.php");

function doGetStorageInfo($conn, $userId)
{
    return json_encode(getStorageInfo($conn, $userId));
}

function doGetRecentActivityInfo($conn, $userId)
{
    return json_encode(getRecentActivityInfo($conn, $userId));
}
