<?php
session_start();

if (!empty($_SESSION['Users'])){

    session_destroy();

    header('Location: ../index.php');
}