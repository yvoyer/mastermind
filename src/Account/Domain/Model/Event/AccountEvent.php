<?php declare(strict_types=1);

namespace Star\Mastermind\Account\Domain\Model\Event;

use Star\Mastermind\Account\Domain\Model\AccountId;
use Star\Mastermind\Common\Domain\Model\BaseEvent;

interface AccountEvent extends BaseEvent
{
    public function accountId(): AccountId;
}
