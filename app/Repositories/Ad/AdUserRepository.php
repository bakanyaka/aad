<?php


namespace App\Repositories\Ad;


use Adldap\Adldap;
use Adldap\Contracts\AdldapInterface;
use App\Models\Ad\Department;
use App\Models\Ad\User;

class AdUserRepository implements IAdUserRepository
{
    /**
     * @var \Adldap\Contracts\AdldapInterface
     */
    private $adldap;

    private $search;

    /**
     * AdUserRepository constructor.
     * @param AdldapInterface $adldap
     */
    public function __construct(AdldapInterface $adldap)
    {
        $this->adldap = $adldap->getDefaultProvider();
        $this->search = $this->adldap->search()->users();
    }

    public function findByName($name)
    {
        return $this->search->whereContains('name', $name)->get()->map(function ($item){
            return $this->mapAdUserToUser($item);
        });
    }

    public function findByAccount($account)
    {
        // TODO: Implement findByAccount() method.
    }

    public function findByComputer($computerName)
    {
        // TODO: Implement findByComputer() method.
    }

    public function findByDepartment($departmentNumber)
    {
        // TODO: Implement findByDepartment() method.
    }

    public function where($field, $value, $equality = 'orcontains')
    {

    }

    public function textSearch()
    {

    }

    public function all()
    {
        // TODO: Implement all() method.
    }

    private function mapAdUserToUser(\Adldap\Models\User $adUser) {
        $user = new User();
        $user->account = $adUser->getAttribute('samaccountname',0);
        $user->name = $adUser->getAttribute('name',0);
        return $user;
    }
}