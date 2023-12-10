<?php

namespace CustomBundles\ChainCommandBundle;

use CustomBundles\ChainCommandBundle\DependencyInjection\ChainCommandBundleExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ChainCommandBundle extends Bundle
{
    public function getPath(): string
    {
        return dirname(__DIR__);
    }

    public function getContainerExtension(): ?ExtensionInterface
    {
        return new ChainCommandBundleExtension();
    }
}
