<?php
require_once "../vendor/autoload.php";

use app\core\App;

$app = new App();
$python = $app->python;
$Snippet = $app->snippet;

echo $Snippet->gen("print(f'hello world {|&data|*7*|&test|}'); print('--Hello')", function ($data,$test) {
    $data = 2;
    $test = 9;
    $data2 = $data*5;
    return [$data2 , $test];
});
