<?php


namespace App\Core\Domain\Model\Client;


use App\Core\Application\Command\Client\CreateClientDTO;
use App\Core\Domain\Model\Client\GS\ClientGS;
use App\Core\Domain\Model\Users\User;
use DateTime;
use Doctrine\Common\Collections\Collection;


class Client
{
    use ClientGS;

    private string $id;

    private string $name;

    private string $city;

    private string $street;

    private string $zipCode;

    private string $numberHouse;

    private ?string $taxNumber = null;

    private DateTime $createAt;

    private User $user;

    private Collection $task;

    private float $salary;

    private bool $gross;


    public function __construct()
    {
        $this->id       = uuid_create();
        $this->createAt = new DateTime();
        $this->gross    = false;
    }

    final public function handler(
        CreateClientDTO $createClientDTO
    ): void
    {
        $this->name        = $createClientDTO->getName();
        $this->city        = $createClientDTO->getCity();
        $this->street      = $createClientDTO->getStreet();
        $this->zipCode     = $createClientDTO->getZipCode();
        $this->taxNumber   = $createClientDTO->getTaxNumber();
        $this->salary      = $createClientDTO->getSalary();
        $this->gross       = $createClientDTO->isGross();
    }

    final public function handlerUser(
        User $user
    ): void
    {
        $this->user = $user;
    }

}
