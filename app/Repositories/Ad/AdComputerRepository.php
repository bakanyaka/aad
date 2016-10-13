<?php


namespace App\Repositories\Ad;


use Adldap\Contracts\AdldapInterface;
use Adldap\Utilities;
use App\Models\Ad\Computer;
use App\Repositories\IComputerRepository;

class AdComputerRepository implements IComputerRepository
{

    /**
     * @var \Adldap\Contracts\Connections\ProviderInterface
     */
    protected $adldap;

    protected $search;


    /**
     * AdComputerRepository constructor.
     * @param AdldapInterface $adldap
     */
    public function __construct(AdldapInterface $adldap)
    {
        $this->adldap = $adldap->getDefaultProvider();
    }

    public function findByName($name)
    {
        // TODO: Implement findByName() method.
    }

    public function findByUsername($username)
    {
        return $this->search()->whereStartsWith('description', $username)->get()->map(function ($item){
            return $this->mapAdComputerToComputer($item);
        });
    }

    public function findBy($field, $value, $equality = 'defaultEquality')
    {
        // TODO: Implement findBy() method.
    }

    public function all()
    {
        // TODO: Implement all() method.
    }

    protected function search() {
        return $this->search = $this->adldap->search()->computers();
    }

    protected function mapAdComputerToComputer(\Adldap\Models\Computer $adComputer)
    {
        $computer = new Computer();
        $computer->name = $adComputer->getName();
        $unixTime = intval(Utilities::convertWindowsTimeToUnixTime($adComputer->getLastLogon()));
        $computer->lastComputerLogonDateUnix = $unixTime;
        $computer->lastComputerLogonDate = new \DateTime(date($adComputer->dateFormat, $unixTime));
        return $computer;
    }
}