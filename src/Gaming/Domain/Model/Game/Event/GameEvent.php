<?php declare(strict_types=1);

namespace Star\Mastermind\Gaming\Domain\Model\Game\Event;

use Star\Mastermind\Common\Domain\Model\BaseEvent;
use Star\Mastermind\Gaming\Domain\Model\Game\GameId;

interface GameEvent extends BaseEvent
{
    public function gameId(): GameId;
}
