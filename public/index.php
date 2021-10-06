<?php
//Important to load classes, controllers etc
require  dirname(__DIR__). '/vendor/autoload.php';
    
//get the url
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

//if path is /, then we redirect to taches-list.php which is the index page
if($path==='/')
{
    include_once(dirname(__DIR__). '/view/taches-list.php');
}
//If the url doesn't have .php
if(!strpos($path,'.php'))
{
    //We verify if the file exists and we add .php
    if(!file_exists(dirname(__DIR__).'/view'.$path.'.php'))
    {
        //it doesn't exist so we redirect to error404 not found page
        include_once(dirname(__DIR__). '/view/error404.php');
        exit;
    }
    else
    {
        //It exists so we include the file and we add .php to it
        include_once(dirname(__DIR__). '/view'.$path.'.php');
    }
}
//Else the url already has .php
else
{
    //Ifthe file doesn't exist
    if(!file_exists(dirname(__DIR__).'/view'.$path))
    {
        //it doesn't exist so we redirect to error404 not found page
        include_once(dirname(__DIR__). '/view/error404.php');
        exit;
    }
    //Else we redirect to the page
    else{
        include_once(dirname(__DIR__). '/view'.$path);
    }
}
