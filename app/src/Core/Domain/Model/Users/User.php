<?php


namespace App\Core\Domain\Model\Users;


 use App\Core\Application\Command\User\CreateUserDTO;
 use App\Core\Domain\Model\Users\GS\UserGS;
 use App\Core\Domain\Model\Wallet\Wallet;
 use DateTime;
 use Doctrine\Common\Collections\Collection;
 use Symfony\Component\Security\Core\User\UserInterface;

 /**
  * @method string getUserIdentifier()
  */
class User implements UserInterface
{
    use UserGS;

    private string $id;

    private string $username;

    private string $firstName;

    private string $lastName;

    private string $email;

    private string $password;

    private DateTime $createdAt;

    private bool $enabled;

    private array $roles;

    private ?Collection $tasks = null;

    private ?Collection $client = null;

    private Wallet $wallet;

    private ?Collection $walletControl = null;

    private Collection $typeText;

    private string $codeAuth;

    private DateTime $dateAuthAt;

    private DateTime $changePasswordAt;

    private DateTime $disabledAccount;


    public function __construct()
    {
        $this->id        = uuid_create();
        $this->createdAt = new \DateTime();
        $this->wallet    = new Wallet();
        $this->enabled   = false;
    }

    final public function createUsers(
        CreateUserDTO $createUserDTO
    ): void
    {
        $this->wallet    = new Wallet();
        $this->username  = $createUserDTO->getUsername();
        $this->firstName = $createUserDTO->getFirstName();
        $this->lastName  = $createUserDTO->getLastName();
        $this->email     = $createUserDTO->getEmail();
        $this->roles     = $createUserDTO->getRoles();
        $this->enabled   = $createUserDTO->isEnable();
    }

    final public function addPassword(
        string $passwordDTO
    ): void
    {
        $this->password         = password_hash($passwordDTO, PASSWORD_BCRYPT);
        $this->changePasswordAt = new \DateTime();
        $this->codeAuth         = uuid_create();
        $this->enabled          = true;
    }

    final public function disableAccount(): void
    {
        $this->disabledAccount = new \DateTime();
        $this->enabled         = false;
    }

    final public function newTokenResetPassword(string $hashToken): void
    {
        $this->codeAuth   = $hashToken;
        $this->dateAuthAt = new \DateTime();
    }

    final public function managerEnabledUser(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

     final public function __call($name, $arguments): void
     {
         // TODO: Implement @method string getUserIdentifier()
     }

 }
