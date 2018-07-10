<?php
require_once 'config.php';
require_once 'vendor/autoload.php';
require_once 'libs/Main.class.php';
$twig = Main::init();
echo $twig->render('index.tmpl.php', Main::getGlobals());

