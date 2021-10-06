<?php
namespace App\controller;

class ErrorController
{

    public function getErrorMessage()
    {
        $errorMessage = "Oops, la page demandée n'existe pas";
        return([
            'errorMessage'=>$errorMessage
        ]);
    }
}