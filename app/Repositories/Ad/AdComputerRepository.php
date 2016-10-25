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
        $computer = $this->search()->find($name);
        return $computer ? $this->mapAdComputerToComputer($computer) : null;
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
        return $this->search()->paginate()->getResults()->map(function ($item){
            return $this->mapAdComputerToComputer($item);
        });
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
        if ($adComputer->hasAttribute('description')) {
            $lastUserData = $this->parseLoginData($adComputer->getDescription())->current();
            if ($lastUserData) {
                $computer->lastUserAccount = $lastUserData->account;
                $computer->lastUserLogonDate = $lastUserData->lastLogonDate;
            }
        }
        if ($adComputer->hasAttribute('comment')) {
            $computer->knownUsers = iterator_to_array($this->parseLoginData($adComputer->getAttribute('comment',0)));
        }
        return $computer;
    }

    protected function parseLoginData($loginDataStr)
    {
        preg_match_all('/(\w+)\s@\s(\d{2}.\d{2}.\d{4}\s\d{1,2}:\d{2}:\d{2})/', $loginDataStr, $matches, PREG_SET_ORDER);
        foreach ($matches as $match) {
            $logon = new \stdClass();
            $logon->account = $match[1];
            $logon->lastLogonDate = $match[2];
            yield $logon;
        }
    }
}