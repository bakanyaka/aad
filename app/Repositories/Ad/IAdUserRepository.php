<?php


namespace App\Repositories\Ad;


interface IAdUserRepository
{
    public function findByName($name);
    public function findByAccount($account);
    public function findByComputer($computerName);
    public function findByDepartment($departmentNumber);
    public function where($field, $value, $equality = 'defaultEquality');
    public function all();
}