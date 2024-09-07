<?php

include("../models/AuthModel.php");

function doSignIn($conn, $email, $password)
{
    return json_encode(signIn($conn, $email, $password));
}

function doSignUp($conn, $name, $lastName, $email, $password)
{
    return json_encode(signUp($conn, $name, $lastName, $email, $password));
}
