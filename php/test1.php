<?php
require_once "../vendor/autoload.php";

use app\core\App;

$app = new App();
$python = $app->python;

$app->ini();

for ($i = 0; $i < 6; $i += 2) {
    $output = $python->set('../Python/test1.py')->gen();
    $app->img($output, 'jpg', true, ["border" => "1px solid red"]);
    if (sleep(1) != 0) {
        echo "can't sleep";
        break;
    }
}
