<?php

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    session_start();
    require_once "linkSQL.php";

    $name = $_POST['name'];
    $part = $_POST['part'];
    $sell = $_POST['sell'];
    $description = $_POST['description'];


    //проверка на существование записи в БД, перед записью
    $check_bd = "SELECT part, description  FROM tb_products WHERE part = :part AND description = :description";
    $statement = $connection->prepare($check_bd);
    $data = [
        'part' => $part,
        'description' => $description
    ];
    $statement->execute($data);
    $result =  $statement->fetchAll(PDO::FETCH_ASSOC);

    if(count($result) === 0){

        $path = 'uploads/' . time() . $_FILES['picture']['name'];
        move_uploaded_file($_FILES['picture']['tmp_name'], $path);

        $tb_products = "INSERT INTO tb_products(name, part, sell, description, photo)VALUES (:name, :part, :sell, :description, :photo)";
            $data = [ //обязательно важна последовательность
               'name' => $name,
               'part' => $part,
               'sell' =>  $sell,
               'description'=> $description,
               'photo'=> $path
            ];
    
            $statement = $connection->prepare($tb_products);
            $result = $statement->execute($data);
            $_SESSION['message'] = "Товар успешно добавлен";
            header('Location: profile.php');
    }
    else{
        $_SESSION['message'] = "Такой товар уже существует";
        header('Location: profile.php');
    }

}
   


