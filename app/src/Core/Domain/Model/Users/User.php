<?php


namespace App\Core\Domain\Model\Users;


 use App\Core\Application\Command\User\CreateUserDTO;
 use App\Core\Domain\Model\Users\GS\UserGS;
 use App\Core\Domain\Model\Wallet\Wallet;
 use Doctrine\Common\Collections\ArrayCollection;
 use Doctrine\Common\Collections\Collection;
 use Symfony\Component\Security\Core\User\UserInterface;

 /**
  * @method string getUserIdentifier()
  */
class User implements UserInterface
{
    use UserGS;

    /** @var string */
    private $id;

    /** @var string */
    private $username;

    /** @var string */
    private $firstName;

    /** @var string */
    private $lastName;

    /** @var string */
    private $email;

    /** @var string */
    private $password;

    /** @var \DateTime */
    private $createdAt;

    /** @var boolean */
    private $enabled;

    /** @var array */
    private $roles;

    /** @var null|Collection */
    private $tasks;

    /** @var null|Collection */
    private $client;

    /** @var Wallet */
    private $wallet;

    /** @var ArrayCollection */
    private $walletControl;

    /** @var Collection */
    private $typeText;

    /** @var string */
    private $codeAuth;

    /** @var null|\DateTime */
    private $dateAuthAt;

    /** @var null|\DateTime */
    private $changePasswordAt;

    /** @var \DateTime */
    private $disabledAccount;

    public function __construct()
    {
        $this->id        = uuid_create();
        $this->createdAt = new \DateTime();
        $this->wallet    = new Wallet();
        $this->enabled   = false;
    }

    public function createUsers(
        CreateUserDTO $createUserDTO
    )
    {
        $this->wallet    = new Wallet();
        $this->username  = $createUserDTO->getUsername();
        $this->firstName = $createUserDTO->getFirstName();
        $this->lastName  = $createUserDTO->getLastName();
        $this->email     = $createUserDTO->getEmail();
        $this->roles     = $createUserDTO->getRoles();
        $this->enabled   = $createUserDTO->isEnable();
    }

    public function addPassword(
        string $passwordDTO
    )
    {
        $this->password         = password_hash($passwordDTO, PASSWORD_BCRYPT);
        $this->changePasswordAt = new \DateTime();
        $this->codeAuth         = uuid_create();
        $this->enabled          = true;
    }

    public function disableAccount()
    {
        $this->disabledAccount = new \DateTime();
        $this->enabled         = false;
    }

    public function newTokenResetPassword(string $hashToken)
    {
        $this->codeAuth   = $hashToken;
        $this->dateAuthAt = new \DateTime();
    }

    public function managerEnabledUser(bool $enabled)
    {
        $this->enabled = $enabled;
    }

     public function __call($name, $arguments)
     {
         // TODO: Implement @method string getUserIdentifier()
     }

 }
