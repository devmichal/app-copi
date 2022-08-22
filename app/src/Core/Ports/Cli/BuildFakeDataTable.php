<?php

namespace App\Core\Ports\Cli;

use App\Core\Application\Command\User\CreateUserDTO;
use App\Core\Domain\Model\Users\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class BuildFakeDataTable extends Command
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        string $name = null
    ) {
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this
            ->setName('fake:data:table')
            ->setDescription('This command create fake data-table to testing all app')
            ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $createUserDTO = new CreateUserDTO();
        $createUserDTO->setEmail($_ENV['USER_EMAIL']);
        $createUserDTO->setFirstName($_ENV['USER_FIRST_NAME']);
        $createUserDTO->setLastName($_ENV['USER_LAST_NAME']);
        $createUserDTO->setUsername($_ENV['USER_USERNAME']);
        $createUserDTO->setRoles(['ROLE_ADMIN']);
        $createUserDTO->setEnable(true);

        $user = new User();
        $user->createUsers($createUserDTO);
        $user->addPassword($_ENV['USER_PASSWORD']);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return 1;
    }
}
