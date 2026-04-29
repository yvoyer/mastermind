<?php declare(strict_types=1);

namespace Star\Mastermind\Gaming\Application\Command\Game;

use Star\Mastermind\Account\Domain\Model\AccountId;
use Star\Mastermind\Common\Domain\Model\AppDateTime;
use Star\Mastermind\Gaming\Domain\Model\Game\GameId;
use Star\Mastermind\Gaming\Domain\Model\Player\PlayerId;

final readonly class CreateGame
{
    public function __construct(
        private GameId $gameId,
        private PlayerId $ownerId,
        private AppDateTime $createdAt,
        private AccountId $accountId,
    ) {
    }

    public function getGameId(): GameId
    {
        return $this->gameId;
    }

    public function getOwnerId(): PlayerId
    {
        return $this->ownerId;
    }

    public function createdAt(): AppDateTime
    {
        return $this->createdAt;
    }

    public function accountId(): AccountId
    {
        return $this->accountId;
    }
}
