<?php
require_once "../vendor/autoload.php";

use app\core\App;

$app = new App();
$Snippet = $app->snippet;

$site = "google.com";
$Snippet->gen_live(
    "import subprocess as sub; sub.call('ping |&site|') ",
    1.5,
    1024,
    function ($site) {
        $site = "google.com";
        return [$site];
    },
    function($res){
        return "<b><pre style='color:red'>$res</b></pre>";
    }
);
