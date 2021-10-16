<?php
namespace App\controller;

class SecurityController
{
    public function login()
    {
        if(isset($_POST['username']) && isset($_POST['password'])
        && $_POST['username'] !='' && $_POST['password'] != '')
        {
            var_dump('tot');die;
        }
        
    }
}