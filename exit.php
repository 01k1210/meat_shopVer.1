<?php
session_start();
unset($_SESSION['message']);
header('Location: index.php');