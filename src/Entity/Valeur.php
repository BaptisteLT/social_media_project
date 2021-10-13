<?php

abstract class Valeur
{
    protected $nom;
    protected $prix;
    abstract protected function __construct($a, $b, $c, $d);
    abstract protected function getInfo();
}