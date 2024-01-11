<?php
    session_start();
    // include './settings/verificaation_send_message.php';
    require './settings/connexion.php'; 
    // require './process/message_affichage.php';
    date_default_timezone_set('Europe/Paris');


    $selectmessages = 'SELECT * FROM messages JOIN Users ON messages.user_ID = Users.ID;';
    $add_messages = $connexion->query($selectmessages);
    $messages = $add_messages->fetchAll(PDO::FETCH_ASSOC);



    $selectusers = 'SELECT * FROM Users';
    $add_users = $connexion->query($selectusers);
    $users = $add_users->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRASH-CHAT</title>
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    
<header class="header">

    <div>
        <img src="./images/logo-ecris-removebg-preview.png" alt="trash-chat">
    </div>

    <div class="header-form">

        <i class="fa-regular fa-user fa-2xl" style="color: #000000;"></i> 

        <form action="./process/user_identification.php" method="post">
            <input type="text" placeholder="Nom d'utilisateur" name="userName"></i>
            <input type="hidden" name="adress_ip" value="<?= $_SERVER['REMOTE_ADDR']?>">
            <button type="submit">se connecter</button>
            
        </form>

        <form action="./process/session_leave.php" method="post">
            <button type="submit">Déconnexion</button>
        </form>
    </div>

</header>



<section>

    <div class="echanges">

        <div class="chat">
            <div >

                <?php foreach ($messages as $messages1) { ?>
                    <div class="chat_bubble">
                        <?= $messages1['userName']. "------" . $messages1['date_message'] . "-----" . $messages1['user_message']?>
                    </div>
                <?php } ?>

            </div>
        </div>
            
        <div class="submit">
                
            <form action="../process/message_affichage.php" method="post" class="send_message">
                
                <input type="hidden" name="adress_ip" value="<?= $_SERVER['REMOTE_ADDR']?>">
                <input type="text" name="chat" size="100" placeholder="Votre message ici !">
                    <button type="submit">ENVOYER</button>  

            </form>
                
        </div>
    </div>

    <div>

        <div class="connected">
            <?php if (!empty($_SESSION['Users'])) {
                   ?> <p class="btnvert"></p>Connecter en tant que : <?=$_SESSION['Users'];
            } else {
                ?> <p class="btnrouge"></p>Personne n'est Connecté... <?php
            } ?>
        </div>

        <div>
            <img src="./images/logo-validé.png" alt="logo" height="300px">
        </div>

        <div class="user">
            <?php
                foreach ($users as $users1) {
                    ?><div class="list-user"><?= $users1['userName'] ."<br>" . $messages1['userIP'] ?></div><?php
                }
            ?>
        </div>
    </div>


</section>



<footer>
    <div>
        
    </div>
</footer>

<script src="./JS/index.js"></script>
</body>
</html>