<?php

namespace CustomBundles\ChainCommandBundle\EventSubscriber;

use CustomBundles\ChainCommandBundle\Exceptions\ChainCommandException;
use CustomBundles\ChainCommandBundle\Interface\ChainCommandInterface;
use Symfony\Component\Console\Event\ConsoleCommandEvent;
use Symfony\Component\Console\Event\ConsoleEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ChainCommandSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            ConsoleCommandEvent::class => [
                ['processCommand', 10]
            ],
        ];
    }

    public function processCommand(ConsoleEvent $event): void
    {
        $command = $event->getCommand();
        if ($command instanceof ChainCommandInterface) {
            throw new ChainCommandException(
                "{$command->getName()}" . ' command is a member of a command chain and cannot be executed on its own'
            );
        }

        foreach ($command->getApplication()->all() as $child) {
            if ($child instanceof ChainCommandInterface) {
                if (get_class($command) === $child->getMaster()) {
                    $child->run($event->getInput(), $event->getOutput());
                }
            }
        }
    }
}
