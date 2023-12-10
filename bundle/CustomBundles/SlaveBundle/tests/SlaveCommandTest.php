<?php

namespace CustomBundles\SlaveBundle\tests;

use CustomBundles\ChainCommandBundle\EventSubscriber\ChainCommandSubscriber;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Event\ConsoleCommandEvent;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\EventDispatcher\EventDispatcher;

class SlaveCommandTest extends KernelTestCase
{
    public function testExecuteSuccessful(): void
    {
        $message = '';
        self::bootKernel();
        $application = new Application(self::$kernel);

        $command = $application->find('slave:hello');
        $commandTester = new CommandTester($command);
        $subscriber = new ChainCommandSubscriber();
        $dispatcher = new EventDispatcher();

        $commandTester->execute([]);
        $event = new ConsoleCommandEvent($command, $commandTester->getInput(), $commandTester->getOutput());
        $dispatcher->addSubscriber($subscriber);
        try {
            $dispatcher->dispatch($event);
        } catch (\Exception $exception) {
            $message = $exception->getMessage();
        }
        $this->assertStringContainsString(
            'command is a member of a command chain and cannot be executed on its own',
            $message
        );
    }
}
