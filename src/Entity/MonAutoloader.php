<?php
class MonAutoloader{

    public static function register(){
        spl_autoload_register([__CLASS__.'autoload']);
    }

    private static function autoload($nomClass){
        require 'classes'.$nomClass.'.php';
    }
}