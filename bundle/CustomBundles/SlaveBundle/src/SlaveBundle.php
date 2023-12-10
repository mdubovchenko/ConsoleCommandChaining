<?php

namespace CustomBundles\SlaveBundle;

use CustomBundles\SlaveBundle\DependencyInjection\SlaveBundleExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class SlaveBundle extends Bundle
{
    public function getPath(): string
    {
        return dirname(__DIR__);
    }

    public function getContainerExtension(): ?ExtensionInterface
    {
        return new SlaveBundleExtension();
    }
}