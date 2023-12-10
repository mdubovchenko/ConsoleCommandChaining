<?php

namespace CustomBundles\SlaveBundle\Command;

use CustomBundles\ChainCommandBundle\Command\ChainCommand;
use CustomBundles\ChainCommandBundle\Interface\ChainCommandInterface;
use CustomBundles\MasterBundle\Command\MasterCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SlaveCommand extends Command implements ChainCommandInterface
{
    use ChainCommand;

    public function __construct(
    ) {
        parent::__construct('slave:hello');
        $this->setMaster(MasterCommand::class);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Hello from Slave!');

        return Command::SUCCESS;
    }
}
