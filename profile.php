<?php
    session_start();
    require_once "linkSQL.php";

    if(isset($_GET['del'])){
        $id = $_GET['del'];
        $del = "DELETE FROM tb_products WHERE id = $id";
        $res = $connection->exec($del);
        if($res){
            $_SESSION['message'] = "Товар успешно Удалён";
        }
    }
    
    $sth = $connection ->prepare("SELECT * FROM tb_products");
    $sth->execute();
    $arrays = $sth->fetchAll(PDO::FETCH_ASSOC);

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container mt-4">
    <a class="exit" href="exit.php">ВЫЙТИ</a>
        <div class="row">
            <div class="col-md-4">
            <div class="card-wrap col-md-12">
            <form class="adm" method="post" name="admin" enctype="multipart/form-data" action="server.php">
    <?php
            if(isset($_SESSION['message'])){

                echo '<div class="alert alert-warning" role="alert">
                <p class="massage"> ' . $_SESSION['message'] . ' </p>
              </div>';
            }
            unset($_SESSION['message']);
            ?> 
        <h3>Мясо</h3>
        <label for="name">Вид:</label>
        <input placeholder="свинина или говядина" required name="name" type="text">
        <label for="part">Часть туши</label>
        <input required name="part" type="text">
        <label for="sell">Цена за кг:</label>
        <input required name="sell" type="number">
        <label for="description">Описание товара</label>
        <textarea required name="description" cols="30" rows="10"></textarea>
        <label for="picture">Фото</label>
        <input required  name="picture" type="file">
        <input type="submit">
    </form>
        </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                <?php foreach($arrays as $array): ?>
                <div class="card-wrap col-md-6">
                    <div class="admin card mb-2">
                        <img class="card-img-top" src="<?=$array['photo'] ?>" alt="">
                        <div class="card-body">
                        <h3 class="card-title"><?=$array['name'] ?></h5>
                        <p class="card-text"><?=$array['part'] ?></p>
                        <p class="card-text"><?=$array['description'] ?></p>
                        <p class="card-text"><?=$array['sell'] ?></p>
                        <a class="btn btn-light" href="?del=<?=$array['id']?>" role="button">Удалить</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- <script src="script.js"></script> -->
</body>
</html>