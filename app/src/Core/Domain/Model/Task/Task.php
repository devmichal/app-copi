<?php


namespace App\Core\Domain\Model\Task;


use App\Core\Application\Command\Task\CreateTaskDTO;
use App\Core\Domain\Model\Client\Client;
use App\Core\Domain\Model\Task\GS\TaskGS;
use App\Core\Domain\Model\TypeText\TypeText;
use App\Core\Domain\Model\Users\User;
use App\Core\Domain\Model\Wallet\WalletTask;
use Doctrine\Common\Collections\Collection;


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

    private ?Collection $files = null;

    private WalletTask $walletTask;


    public function __construct(
        User $user
    )
    {
        $this->id         = uuid_create();
        $this->users      = $user;
        $this->walletTask = new WalletTask();
        $this->status     = false;
    }

    /**
     * @throws \Exception
     */
    final public function factoryTask(
        CreateTaskDTO $createTaskDTO,
        float $payoutMoney
    ): void
    {
        $this->taskDate             = new TaskDate($createTaskDTO);
        $this->titleTask            = $createTaskDTO->getTitleTask();
        $this->client               = $createTaskDTO->getClient();
        $this->numberCountCharacter = $createTaskDTO->getNumberCountCharacter();
        $this->typeText             = $createTaskDTO->getTypeText();
        $this->status               = $createTaskDTO->isStatus();
        $this->walletTask->updateVariable($payoutMoney);
    }

}
