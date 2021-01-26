<?php
require_once "../../vendor/autoload.php";

use app\core\App;

$app = new App();
$python = $app->python;

$data1 = [
    'img' => $app->path(__DIR__, '../../Test/img/sora.jpg')
];
$output = $python->set("../../Python/test3.py")->send($data1)->gen();
$app->img($output, 'jpg', true, ['border' => '10px solid red']);
