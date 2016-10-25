<?php


namespace App\Services;


use App\Repositories\IComputerRepository;
use App\Repositories\IUserRepository;

class SearchService
{
    /**
     * @var IUserRepository
     */
    protected $users;

    /**
     * @var IComputerRepository
     */
    protected $computers;

    /**
     * SearchService constructor.
     * @param IUserRepository $userRepository
     * @param IComputerRepository $computerRepository
     */
    public function __construct(IUserRepository $userRepository, IComputerRepository $computerRepository)
    {
        $this->users = $userRepository;
        $this->computers = $computerRepository;
    }

    public function findUser($query)
    {
        if(preg_match('/^[A-z]{2,4}\d{0,3}-\d{2,}/',$query)) {
            return $this->findUserByComputer($query);
        } elseif (preg_match('/^([a-z]{0,5}\d{4,6})/',$query,$matches)) {
            return $this->users->getByAccount($matches[1]);
        } elseif (preg_match('/^(?:[\+\(\)\d\s])*\d+(?:-\d+)+$/', $query)) {
            return $this->users->findByPhone($query);
        } else {
            return $this->users->findByName($query);
        }
    }

    public function findUserByComputer($computerName)
    {
        $computer = $this->computers->findByName($computerName);
        if (!$computer || !$computer->lastUserAccount) {
            return null;
        }
        return $this->users->getByAccount($computer->lastUserAccount);
    }
}