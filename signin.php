<?php
//Логин: qwerty123 //Пароль 123qwerty
session_start();
if(strlen($_POST['login']) && strlen($_POST['password']) < 5){
 $_SESSION['message'] = "Длина Логина или пароля слишком короткие!";
 header('Location: admin.php');
}

if($_POST['login'] === 'qwerty123' && $_POST['password'] === '123qwerty'){
 header('Location: profile.php');
}
else{
 $_SESSION['message'] = "Логин или пароль не сопадают!";
 header('Location: admin.php');
}
