<?php
    session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- форма авторизации -->
    <div class="wrapper">
    <form name="signin" action="signin.php" method="post" >
            <h1>Авторизация:</h1>
            <?php
            if(isset($_SESSION['message'])){
                echo '<p class="massage"> ' . $_SESSION['message'] . ' </p>';
            }
            unset($_SESSION['message']);
            ?> 
            <label for="login">Логин</label>
            <input  name="login" type="text">
            <label for="password">Пароль</label>
            <input name="password" type="password">
            <input type="submit" value="Войти">
        </form>
    </div>
</body>
</html>
