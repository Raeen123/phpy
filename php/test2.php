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
$output = $python->gen("../Python/test2.py", $data1, $data2);
var_dump($output);
