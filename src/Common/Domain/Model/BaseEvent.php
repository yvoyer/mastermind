<?php declare(strict_types=1);

namespace Star\Mastermind\Common\Domain\Model;

use Star\Component\DomainEvent\DomainEvent;
use Star\Component\DomainEvent\Serialization\CreatedFromPayload;

interface BaseEvent extends DomainEvent, CreatedFromPayload
{
}
