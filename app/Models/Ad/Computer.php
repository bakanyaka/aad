<?php


namespace App\Models\Ad;


class Computer
{
    public $name;
    public $ipAddress;
    public $os;
    public $lastComputerLogonDate;
    public $lastComputerLogonDateUnix;
    public $lastUser;
    public $lastUserLogonDate;
    public $knownUsers = array();
    public $cpu;
    public $memoryInMb;
    public $diskSpaceInMb;
}