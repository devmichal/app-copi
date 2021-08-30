<?php


namespace App\Core\Domain\Model\Task;


use App\Core\Application\Command\Task\CreateTaskDTO;
use App\Core\Domain\Model\Client\Client;
use App\Core\Domain\Model\File\Files;
use App\Core\Domain\Model\Task\GS\TaskGS;
use App\Core\Domain\Model\TypeText\TypeText;
use App\Core\Domain\Model\Users\User;
use App\Core\Domain\Model\Wallet\WalletTask;
use App\Shared\Domain\Enum\StatusTask;

class Task
{
    use TaskGS;

    /** @var string */
    private $id;

    /** @var string */
    private $titleTask;

    /** @var TaskDate */
    private $taskDate;

    /** @var Client */
    private $client;

    /** @var bool */
    private $status;

    /** @var null|TypeText */
    private $typeText;

    /** @var int */ /*zzs on 1000*/
    private $numberCountCharacter;

    /** @var User */
    private $users;

    /** @var Files */
    private $files;

    /** @var WalletTask */
    private $walletTask; // todo here we will start event sourcing

    public function __construct(
        User $user
    )
    {
        $this->users      = $user;
        $this->id         = uuid_create();
        $this->taskDate   = new TaskDate();
        $this->walletTask = new WalletTask();
        $this->status     = false;
    }

    public function factoryTask(
        CreateTaskDTO $createTaskDTO,
        float $payoutMoney
    )
    {
        $this->titleTask            = $createTaskDTO->getTitleTask();
        $this->client               = $createTaskDTO->getClient();
        $this->numberCountCharacter = $createTaskDTO->getNumberCountCharacter();
        $this->typeText             = $createTaskDTO->getTypeText();
        $this->status               = $createTaskDTO->isStatus();
        $this->walletTask->updateVariable($payoutMoney);
    }

}
