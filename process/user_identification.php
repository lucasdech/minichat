<?php
session_start();


if (!empty($_POST['userName']) ) {

        require_once '../settings/connexion.php';



        $SQLuniqueUser = $connexion->prepare("SELECT * FROM Users WHERE userName = '" . $_POST['userName'] . "'");
        $SQLuniqueUser->execute();
        $uniqueUser = $SQLuniqueUser->fetch(PDO::FETCH_ASSOC);


        if (!empty($uniqueUser['userName'])) {


            $_SESSION['Users'] = $uniqueUser['userName'];

        
        }else{
            $preparedRequest = $connexion->prepare(
                "INSERT INTO Users (userName) VALUES (?)");

            $preparedRequest->execute([
                $_POST['userName']]);

            $_SESSION['Users'] = $_POST['userName'];

            ;}
            
            header('Location: ../index.php');
}
