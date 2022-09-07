<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
 $corzina = json_decode( $_POST['corzina'], true);
 $result = [];
 foreach ($corzina as $elem){
  $res = array_slice($elem, 2);
  $result[] = $res;
 }
 $res = json_encode($result, JSON_UNESCAPED_UNICODE);
 $phone = $_POST['tel'];
 $delivery = $_POST['delivery'];

 /* https://api.telegram.org/bot5567705347:AAFo3GDkwBd8jS6VSGe0EMesSaI-qtnb0ps/getUpdates,
где, XXXXXXXXXXXXXXXXXXXXXXX - токен вашего бота, полученный ранее */

$token = "5567705347:AAFo3GDkwBd8jS6VSGe0EMesSaI-qtnb0ps";
$chat_id = "-716105295";
$arr = array(
  'Пользователь:' => $res,
  'Телефон:' => $phone,
  'delivery' => $delivery
);

$arr = implode('-', $arr);


$sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$arr}","r");

if ($sendToTelegram) {
  echo "спасибо";
} else {
  echo "Error";

}
}