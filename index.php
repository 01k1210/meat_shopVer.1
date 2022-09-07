<?php
require_once "linkSQL.php";

$sth = $connection ->prepare("SELECT * FROM tb_products");
$sth->execute();
$arrays = $sth->fetchAll(PDO::FETCH_ASSOC);
// var_dump($arrays);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная страница</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.min.js" type="text/javascript"></script>
</head>
<body>

    <nav class="navbar navbar-expend-sm navbar-light">
        <div class="container">
            <a class="nav-link" href=""><img src="Img/logo-desktop.svg" alt="логотип компании" width="150" height="50"></a>
            <a class="tel nav-link fs-6 text-body " href="tel:+79001111111">+7(921)788-45-80</a>
            <a class="nav-link cart" href="#corzina">
                <img style="width:40px ;" src="Img/shopping-cart.svg" alt="корзина товаров">
                <span class="small_couneter">0</span>
            </a>
        </div>
    </nav>

    <section class="products">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <!-- <div class="text-center mb-2 fs-5 ">
                            <a class="text-decoration-none text-body navi" href="#" data-action="all">Все категории</a>
                            <a class="text-decoration-none text-body navi" class="#" href="#" data-action="Говядина">Говядина</a>
                            <a class="text-decoration-none text-body navi" href="#" data-action="Свинина">Свинина</a>
                        </div> -->
                    <?php foreach($arrays as $array): ?>

                        <div class="card-wrap col-md-4 to_filter" data-action="<?=$array['name']?>">
                            <div class="card mb-2 " data-id="<?=$array['id']?>">
                                <img class="card-img img-block" src="<?=$array['photo']?>" alt="california-hit">
                                <div class="card-body text-center">
                                    <h4 class="card-title"><?=$array['name']?></h4>
                                    <p class="lead part"><?=$array['part']?></p>
                                    <div class="cart-item__details mb-2">
                                        <div class="cart-item__details-control">
                                            <div data-action="minus" class="control-minus">-</div>
                                            <div data-couneter class="control-info">1</div>   
                                            <div data-action="plus" class="control-plus">+</div>
                                        </div>
                                        <div class="price">
                                            <div class="price__weight">1кг.</div>
                                            <div class="price__currency h5"><?=$array['sell']?> ₽</div>
                                        </div>
                                    </div>
                                    <button data-cart class="btn btn-danger">+ В корзину</button>
                                    
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card mb-2">
                        <div class="card-body">
                            <h4 class="card-title text-center">Ваша мясная корзина</h4>
                            <div class="alert alert-secondary" role="alert">
                                Корзина пуста!
                            </div>
                            <div id="corzina" class="cart-wrap">
                                </div>
                                <div class="cart-total">
                                    <hr>
                                    <p data-cart-delivery class="dNone">
                                        <span class="h5">Доставка:</span>
                                        <span class="h5 delivery">250₽</span>
                                        <span class="smallText">*Бесплатно при заказе от 600₽</span>
                                    </p>
                                    <p>
                                      <span class="h5">Итого:</span>
                                      <span class="h5 total-prise">0₽</span>
                                  </p>
                                  <hr>
                                </div>

                                <div class="form-Bue dNone">
                                    <h5 class="card-title">Оформить заказ</h5>
                                    <form>
                                        <input name="telephone" type="text" class="form-control mb-2" placeholder="Введите телефон">
                                        <button id="tel" type="submit" class="btn btn btn-danger" >Отправить</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <img class="modal_img" src="img/logo-desktop.svg" alt="logo">
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        Благодарим за заказ, наш менеджер свяжеться с вами в ближайшее время!
      </div>
    </div>
  </div>
</div>
    <script src="script.js"></script>
</body>
</html>