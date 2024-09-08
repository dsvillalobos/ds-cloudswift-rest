<?php

function signIn($conn, $email, $password)
{
    try {
        $query = "SELECT * FROM users WHERE Email = :Email LIMIT 1;";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":Email", $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user["Password"])) {
            return $user;
        } else {
            return null;
        }
    } catch (Exception $err) {
        return "Error: " . $err->getMessage();
    }
}

function signUp($conn, $name, $lastName, $email, $password)
{
    try {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (Name, LastName, Email, Password) VALUES (:Name, :LastName, :Email, :Password);";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":Name", $name);
        $stmt->bindParam(":LastName", $lastName);
        $stmt->bindParam(":Email", $email);
        $stmt->bindParam(":Password", $hashedPassword);
        $stmt->execute();

        return "Success: User created successfully";
    } catch (Exception $err) {
        return "Error: " . $err->getMessage();
    }
}
