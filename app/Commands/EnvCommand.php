<?php

/*
 * This file is part of james.xue/search.
 *
 * (c) vinhson <15227736751@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 *
 */

namespace App\Commands;

use Symfony\Component\Finder\Finder;
use Vinhson\Search\Commands\Command;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class EnvCommand extends Command
{
    protected function configure()
    {
        $this->setName('run')
            ->setDescription('设置 .env 配置信息');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $directory = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "laravel";

        $finder = new Finder();
        $envFile = iterator_to_array($finder->files()->ignoreDotFiles(false)->in($directory)->name('.env'));
        $envFileContent = reset($envFile)->getContents();

        $newEnvFile = str_replace(['DB_HOST=127.0.0.1','REDIS_HOST=127.0.0.1'], ['DB_HOST=mysql', 'REDIS_HOST=redis'], $envFileContent);

        $filesystem = new Filesystem();
        $filesystem->dumpFile($directory . "/.env", $newEnvFile);

        $output->writeln("<info>set successfully</info>");

        return self::SUCCESS;
    }
}
