<?php

session_start();
require '../settings/connexion.php'; 
date_default_timezone_set('Europe/Paris');


if (!empty($_POST['chat'])) {
    
    // Récuperer l'utilisateur
    $preparedRequestGetUser = $connexion->prepare(
       "SELECT * FROM Users WHERE userName = ?"
    );
    $preparedRequestGetUser->execute([
       $_SESSION['Users']
    ]);
    $user = $preparedRequestGetUser->fetch(PDO::FETCH_ASSOC);

    $preparedRequest = $connexion->prepare(
        "INSERT INTO messages (user_ID, date_message, userIP, user_message) VALUES (?,?,?,?)"
    );
    $preparedRequest->execute([

        $user['ID'],
        date("Y-m-d H:i:s"),
        $_POST['adress_ip'],
        $_POST['chat'],
        
    ]);

    header('Location: ../index.php');
    
    
    
}
