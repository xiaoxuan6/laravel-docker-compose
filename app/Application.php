<?php


namespace App;


use App\Commands\EnvCommand;
use Symfony\Component\Console\Exception\ExceptionInterface;

class Application
{
    /**
     * @throws ExceptionInterface
     */
    public function __invoke()
    {
        (new \Symfony\Component\Console\Application())->add(new EnvCommand::class)->run();
    }
}
