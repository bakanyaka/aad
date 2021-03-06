<?php


namespace App\Repositories\Ad;


use Adldap\Contracts\AdldapInterface;
use Adldap\Exceptions\ModelNotFoundException;
use Adldap\Utilities;
use App\Models\Ad\Department;
use App\Models\Ad\User;
use App\Repositories\IUserRepository;
use App\Repositories\IDepartmentRepository;


class AdUserRepository implements IUserRepository
{
    /**
     * @var \Adldap\Contracts\AdldapInterface
     */
    private $adldap;

    /**
     * @var \Adldap\Search\Factory
     */
    private $search;

    private $departments;

    /**
     * AdUserRepository constructor.
     * @param AdldapInterface $adldap
     * @param IDepartmentRepository $depRepo
     */
    public function __construct(AdldapInterface $adldap, IDepartmentRepository $depRepo)
    {
        $this->adldap = $adldap->getDefaultProvider();
        $this->departments = $depRepo;
    }

    /**
     * @param string $name
     * @return \Illuminate\Support\Collection;
     */
    public function findByName($name)
    {
        return $this->search()->whereContains('name', $name)->get()->map(function ($item){
            return $this->mapAdUserToUser($item);
        });
    }

    /**
     * @param string $account
     * @return \App\Models\Ad\User | boolean;
     */
    public function getByAccount($account)
    {
        $user = $this->search()->findBy('samaccountname', $account);
        return $user ? $this->mapAdUserToUser($user) : null;
    }

    public function findByDepartment(Department $department)
    {
        // TODO: Implement findByDepartment() method.
    }

    public function findByPhone(string $phone) {
        return $this->search()
            ->orWhereContains('telephonenumber', $phone)
            ->orWhereContains('pager', $phone)
            ->orWhereContains('mobile', $phone)
            ->get()->map(function ($adUser){
                return $this->mapAdUserToUser($adUser);
            });
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

    /**
     * Sets search property to a new instance of query builder limited to user and returns it
     * @return \Adldap\Search\Factory
     */
    private function search() {
        return $this->search = $this->adldap->search()->where([
            $this->adldap->getSchema()->objectClass()    => $this->adldap->getSchema()->objectClassUser(),
            $this->adldap->getSchema()->objectCategory() => $this->adldap->getSchema()->objectCategoryPerson(),
        ]);
    }

    /**
     * @param \Adldap\Models\User $adUser
     * @return \App\Models\Ad\User
     */
    private function mapAdUserToUser(\Adldap\Models\User $adUser) {
        $user = new User();
        $unixTime = Utilities::convertWindowsTimeToUnixTime($adUser->getLastLogon());
        $user->lastLogonDate = new \DateTime(date($adUser->dateFormat, intval($unixTime)));
        $user->lastLogonDateUnix = intval($unixTime);
        $user->account = $adUser->getAttribute('samaccountname',0);
        $user->name = $adUser->getAttribute('name',0);
        $user->email = $adUser->getAttribute('userprincipalname', 0);
        $user->extEmail = $adUser->getAttribute('homephone', 0);
        $user->localPhone = $adUser->getAttribute('telephonenumber', 0);
        $user->cityPhone = $adUser->getAttribute('pager', 0);
        $user->mobilePhone = $adUser->getAttribute('mobile', 0);
        $user->departmentName = $adUser->getAttribute('department', 0);
        $user->title = $adUser->getAttribute('title',0);
        $user->company = $adUser->getAttribute('company', 0);
        $user->office = $adUser->getAttribute('physicaldeliveryofficename',0);
        $user->disabled = (bool)($adUser->getAttribute('useraccountcontrol',0) & 0x2);
        $user->sortWeight = $adUser->hasAttribute('primarytelexnumber') ? $adUser->getAttribute('primarytelexnumber', 0) : 99;
        return $user;
    }
}