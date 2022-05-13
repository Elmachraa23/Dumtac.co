<?php
    require_once "core/routeur.php";

    define ( 'ROOT', __DIR__ );
    define ( 'CORE', ROOT."\\Core\\" );
    define ( 'CONTROLLERS', ROOT."\\Controllers\\" );
    define ( 'MODELS', ROOT."\\Models\\" );
    define ( 'VIEWS', ROOT."\\Views\\" );
    define ( 'MENUS', ROOT."\\Menus\\" );
    
    $routeur = new Routeur();
    $routeur->run();

   // https://www.tutorialspoint.com/
   // css-to-put-icon-inside-an-input-element-in-a-form
    /*$timestamp = time();
    echo($timestamp);
    echo "<br>";

    echo(date("F d, Y h:i:s", $timestamp));
*/
?>
