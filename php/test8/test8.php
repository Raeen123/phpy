<?php
require_once "../../vendor/autoload.php";

use app\core\App;

$app = new App();
$Snippet = $app->snippet;

echo $Snippet->require_live('snippet-test8',1,256,function($res){ return "<b><pre>$res</pre></b>";});
