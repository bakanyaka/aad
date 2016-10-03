<?php


namespace App\Repositories;


interface IComputerRepository
{
    public function findByName($name);
    public function findByUsername($username);
    public function findBy($field, $value, $equality = 'defaultEquality');
    public function all();
}