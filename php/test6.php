<?php
require_once "../vendor/autoload.php";

use app\core\App;

$app = new App();
$python = $app->python;

$site = "google.com";
// all , defult time is 1
$python->set("../Python/test6.py")->send($site)->live()->gen(function ($res) {
    return "<pre>$res</pre>";
});

echo "<br>------------------------------------------<br>";
//ini
$python->set("../Python/test6.py")->send($site)->live()->ini(3)->gen(
    function ($res) {
        return "<pre>$res</pre>";
    }
);
