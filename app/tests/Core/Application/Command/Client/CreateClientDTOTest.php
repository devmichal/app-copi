<?php


namespace App\Tests\Core\Application\Command\Client;


use App\Core\Application\Command\Client\CreateClientDTO;

final class     CreateClientDTOTest
{
    public static function createClient(): CreateClientDTO
    {
        $createClientDTO = new CreateClientDTO();

        $createClientDTO->setName('Torin');
        $createClientDTO->setCity('Erebor');
        $createClientDTO->setStreet('Alone mountain');
        $createClientDTO->setSalary(12.1);
        $createClientDTO->setTaxNumber('314091409124421');
        $createClientDTO->setZipCode('66-666');
        $createClientDTO->setGross(false);

        return $createClientDTO;
    }
}