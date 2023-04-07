<?php


namespace App\Commands;


use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Vinhson\Search\Commands\Command;

class EnvCommand extends Command
{
    protected function configure()
    {
        $this->setName('run')
            ->setDescription('设置 .env 配置信息');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        var_export('111');
    }
}
