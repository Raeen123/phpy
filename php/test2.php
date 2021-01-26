<?php
require_once "../vendor/autoload.php";

use app\core\App;

$app = new App();
$python = $app->python;

$data1 = [
    'name' => 'raeen',
    'library' => 'phpy'
];
$data2 = "test";
$output = $python->set("../Python/test2.py")->send($data1,$data2)->gen();
var_dump($output);
