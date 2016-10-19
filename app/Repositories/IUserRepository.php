<?php


namespace App\Repositories;


use App\Models\Ad\Department;

interface IUserRepository
{
    public function findByName($name);
    public function getByAccount($account);
    public function findByDepartment(Department $department);
    public function where($field, $value, $equality = 'defaultEquality');
    public function all();
}