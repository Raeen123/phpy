<?php
require_once "../vendor/autoload.php";

use app\core\App;

$app = new App();
$python = $app->python;

$site = "google.com";
$python->gen_live(
    "../Python/test6.py",
    1,
    1024,
    [$site],
    function ($res) {
        return "<pre>$res</pre>";
    }
);
