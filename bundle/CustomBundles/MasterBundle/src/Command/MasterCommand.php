<?php

namespace CustomBundles\MasterBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MasterCommand extends Command
{
    public function __construct(
    ) {
        parent::__construct('master:hello');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Hi from Master!');

        return Command::SUCCESS;
    }
}
