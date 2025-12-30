<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use Hoanguyencoder\HttpStatus\lib\CheckUrl as HttpStatus;
$url = $_POST['url'] ?? '';

$result = HttpStatus::check($url);

if($result == 0){
     $url = $url ."Link not found";
     $result = '404';
}

echo json_encode(array( 'url' => $url,'status' => $result));

?>