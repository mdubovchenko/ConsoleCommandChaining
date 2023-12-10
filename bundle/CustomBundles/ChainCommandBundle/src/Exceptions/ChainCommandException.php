<?php

namespace CustomBundles\ChainCommandBundle\Exceptions;

use Exception;
use Symfony\Component\Console\Exception\ExceptionInterface;

class ChainCommandException extends Exception implements ExceptionInterface
{
}
