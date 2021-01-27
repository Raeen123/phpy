<?php
require_once "../vendor/autoload.php";

use app\core\App;

$app = new App();
$python = $app->python;
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $output = $python->set("../Python/test9.py")->send($name)->gen();
    echo $output;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Speak</title>
</head>
<body>
    <form  method="post">
        <input type="text" name="name" placeholder="name" > 
        <button type="submit" name="submit" >clik me</button>
    </form>
    
</body>
</html>