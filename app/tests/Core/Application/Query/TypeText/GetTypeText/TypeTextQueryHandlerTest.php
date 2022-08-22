<?php

namespace App\Tests\Core\Application\Query\TypeText\GetTypeText;

use App\Core\Application\Command\TypeText\CreateTypeTextDTO;
use App\Core\Application\Query\TypeText\GetTypeText\TypeTextQuery;
use App\Core\Application\Query\TypeText\GetTypeText\TypeTextQueryHandler;
use App\Core\Domain\Model\TypeText\TypeText;
use App\Core\Domain\Model\Users\User;
use App\Core\Infrastructure\Repository\TypeText\MatchTextType;
use PHPUnit\Framework\TestCase;

class TypeTextQueryHandlerTest extends TestCase
{
    public const DESCRIPTION = 'some_description';

    /** @var MatchTextType|\PHPUnit\Framework\MockObject\MockObject */
    private $matchTextType;

    /** @var User|mixed|\PHPUnit\Framework\MockObject\MockObject */
    private $user;

    protected function setUp(): void
    {
        $this->user = $this->createMock(User::class);

        $this->matchTextType = $this->createMock(MatchTextType::class);
    }

    public function testShouldReturnEmptyTypeText()
    {
        $command = new TypeTextQuery($this->user);
        $handler = new TypeTextQueryHandler($this->matchTextType);
        $result = $handler($command);

        $this->assertEmpty($result);
        $this->assertEquals(0, count($result));
    }

    public function testShouldReturnFullyTypeText()
    {
        $this->matchTextType
             ->method('getTypeText')
             ->willReturn($this->createResponseFindTypeText());

        $command = new TypeTextQuery($this->user);
        $handler = new TypeTextQueryHandler($this->matchTextType);
        $result = $handler($command);

        $this->assertIsArray($result);
        $this->assertEquals(2, count($result));
        $this->assertEquals(self::DESCRIPTION, $result[0]->getDestination());
    }

    private function createResponseFindTypeText(): array
    {
        $createTypeText = new CreateTypeTextDTO();
        $createTypeText->setDestination(self::DESCRIPTION);

        $firstType = new TypeText();
        $firstType->handlerDTO($createTypeText);

        $secondType = new TypeText();
        $secondType->handlerDTO($createTypeText);

        return [$firstType, $secondType];
    }
}
