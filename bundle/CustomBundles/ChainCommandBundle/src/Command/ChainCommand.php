<?php

namespace CustomBundles\ChainCommandBundle\Command;

trait ChainCommand
{
    protected array $commands = [];

    /**
     * @param string $command
     */
    public function setMaster(string $command): void
    {
        $this->commands[] = $command;
    }

    /**
     * @return string|null
     */
    public function getMaster(): ?string
    {
        return $this->commands[0] ?? null;
    }
}
