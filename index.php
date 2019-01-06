<?php

require_once 'config.php';
require_once 'Base/Controller.php';
require_once 'Base/Model.php';
require_once 'Base/View.php';

$moduleUrl = isset($_GET['module']) ? $_GET['module'] : Config::$moduleDefault;
$controllerUrl = isset($_GET['controller']) ? $_GET['controller'] : Config::$controllerDefault;
$actionUrl = isset($_GET['action']) ? $_GET['action'] : Config::$actionDefault;

$module = ucfirst($moduleUrl);
$controller = ucfirst($controllerUrl) . 'Controller';
$action = ucfirst($actionUrl);

$file = $module . '/Controller/' . $controller . '.php';

if(file_exists($file)){
    require_once "{$file}";
    $c = new $controller($module);
    $c->$action();
}

