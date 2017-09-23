#!/usr/bin/php
<?php

namespace {
    use Star\Mastermind\Domain\Port\Symfony\Console\MasterMindApplication;

    require_once 'vendor/autoload.php';

    $app = new MasterMindApplication();
    $app->run();
}
