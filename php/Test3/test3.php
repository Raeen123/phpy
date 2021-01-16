<?php
require_once "../../vendor/autoload.php";

use app\core\App;

$app = new App();
$python = $app->python;

$data1 = [
    'img' => $python->path_file(__DIR__,'../../Test/img/sora.jpg')
];
$output = $python->gen("../../Python/test3.py", $data1);
$python->img($output,'jpg',true,['border' => '10px solid red']);