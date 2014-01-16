<?php
    require_once("../lib/Twig-1.15.0/lib/Twig/Autoloader.php");
    //require_once("../classes/player/Player.php");
//
//    //$a = new Player();
//    //$a->set_Id(1);
    //var_dump($a);

    Twig_Autoloader::register();

    // Load template files from the ./tpl/ folder and use ./tpl/cache/ for caching
    $twig = new Twig_Environment( new Twig_Loader_Filesystem("html"));

    // Load and render 'template.tpl'
    $tpl = $twig->loadTemplate( "index.html" );
    echo $tpl->render(array("title" => "TESTING TWIG", "main_para" => "ASHWIN IS THE GREATEST!"));
?>

