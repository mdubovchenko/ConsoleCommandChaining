<?php

namespace CustomBundles\MasterBundle;

use CustomBundles\MasterBundle\DependencyInjection\MasterBundleExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class MasterBundle extends Bundle
{
    public function getPath(): string
    {
        return dirname(__DIR__);
    }

    public function getContainerExtension(): ?ExtensionInterface
    {
        return new MasterBundleExtension();
    }
}
