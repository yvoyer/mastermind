<?php

namespace Star\Mastermind\Domain\Port\Symfony\Console;

use Symfony\Component\Console\Application;

final class MasterMindApplication extends Application
{
    const VERSION = '1.0.0';

    public function __construct() {
        parent::__construct('Mastermind',self::VERSION);
        $this->add(new RunCommand());
    }
}
