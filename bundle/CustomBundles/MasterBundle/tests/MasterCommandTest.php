<?php

namespace CustomBundles\MasterBundle\tests;

use CustomBundles\ChainCommandBundle\EventSubscriber\ChainCommandSubscriber;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Event\ConsoleCommandEvent;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\EventDispatcher\EventDispatcher;

class MasterCommandTest extends KernelTestCase
{
    public function testExecuteSuccessful(): void
    {
        self::bootKernel();
        $application = new Application(self::$kernel);

        $command = $application->find('master:hello');
        $commandTester = new CommandTester($command);
        $subscriber = new ChainCommandSubscriber();
        $dispatcher = new EventDispatcher();

        $commandTester->execute([]);
        $event = new ConsoleCommandEvent($command, $commandTester->getInput(), $commandTester->getOutput());
        $dispatcher->addSubscriber($subscriber);
        $dispatcher->dispatch($event);

        $commandTester->assertCommandIsSuccessful();

        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('Hi from Master!', $output);
    }

    public function testExecuteFailure(): void
    {
        self::bootKernel();
        $application = new Application(self::$kernel);

        $command = $application->find('master:hello');
        $commandTester = new CommandTester($command);
        $subscriber = new ChainCommandSubscriber();
        $dispatcher = new EventDispatcher();

        $commandTester->execute([]);
        $event = new ConsoleCommandEvent($command, $commandTester->getInput(), $commandTester->getOutput());
        $dispatcher->addSubscriber($subscriber);
        $dispatcher->dispatch($event);

        $commandTester->assertCommandIsSuccessful();

        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertStringNotContainsString('Hello from Master!', $output);
    }
}
