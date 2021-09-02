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

    private string $id;

    private string $titleTask;

    private TaskDate $taskDate;

    private Client $client;

    private bool $status;

    private ?TypeText $typeText = null;

     /*zzs on 1000*/
    private int $numberCountCharacter;

    private User $users;

    private ?Files $files = null;

    private WalletTask $walletTask;

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

    final public function factoryTask(
        CreateTaskDTO $createTaskDTO,
        float $payoutMoney
    ): void
    {
        $this->titleTask            = $createTaskDTO->getTitleTask();
        $this->client               = $createTaskDTO->getClient();
        $this->numberCountCharacter = $createTaskDTO->getNumberCountCharacter();
        $this->typeText             = $createTaskDTO->getTypeText();
        $this->status               = $createTaskDTO->isStatus();
        $this->walletTask->updateVariable($payoutMoney);
    }

}
