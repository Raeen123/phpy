<?php
require_once "../vendor/autoload.php";

use app\core\App;

$app = new App();
$python = $app->python;

$python->ini();

for ($i = 0; $i < 6; $i += 2) {
    $output = $python->gen('../Python/test.py');
    $python->img($output, 'jpg', true, ["border" => "1px solid red"]);
    if (sleep(1) != 0) {
        echo "can't sleep";
        break;
    }
    flush();
    ob_flush();
}
