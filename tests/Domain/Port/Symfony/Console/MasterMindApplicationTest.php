<?php

namespace Star\Mastermind\Domain\Port\Symfony\Console;

use Symfony\Component\Console\Tester\ApplicationTester;

final class MasterMindApplicationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ApplicationTester
     */
    private $tester;

    public function setUp()
    {
        $app = new MasterMindApplication();
        $app->setAutoExit(false);
        $this->tester = new ApplicationTester($app);
    }

    public function test_it_should_run_command() {
        $this->markTestIncomplete('Add interactive mode');
        $this->tester->run(['command' => 'run']);
        var_dump($this->tester->getDisplay());
    }
}
