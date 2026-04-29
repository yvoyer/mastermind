<?php declare(strict_types=1);

namespace Star\Mastermind\Gaming\Domain\Model\Player\Event;

use Star\Mastermind\Common\Domain\Model\BaseEvent;
use Star\Mastermind\Gaming\Domain\Model\Player\PlayerId;

interface PlayerDomainEvent extends BaseEvent
{
    public function playerId(): PlayerId;
}
