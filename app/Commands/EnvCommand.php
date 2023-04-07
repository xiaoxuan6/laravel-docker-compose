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
        $baseDirectory = dirname(dirname(__DIR__));

        $searchCollect = collect(['DB_HOST=127.0.0.1','REDIS_HOST=127.0.0.1', 'DB_DATABASE=homestead', 'DB_USERNAME=homestead','DB_PASSWORD=secret']);
        $replaceCollect = collect(['DB_HOST=mysql', 'REDIS_HOST=redis']);

        // docker .env
        $finder = new Finder();
        $dockerEnvFile = iterator_to_array($finder->files()->ignoreDotFiles(false)->in($baseDirectory)->name('.env'));
        $dockerEnvContent = reset($dockerEnvFile)->getContents();

        $dockerEnvArr = array_filter(preg_split("/\r\n|\n|\r/", $dockerEnvContent));
        $replaceCollect->push(...$dockerEnvArr);

        $this->replaceEnv($searchCollect->toArray(), $replaceCollect->toArray());

        $output->writeln("<info>Application env set successfully</info>");

        return self::SUCCESS;
    }

    protected function replaceEnv($search, $replace)
    {
        $directory = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "laravel";

        $finder = new Finder();
        $envFile = iterator_to_array($finder->files()->ignoreDotFiles(false)->in($directory)->name('.env'));
        $envFileContent = reset($envFile)->getContents();

        $newEnvFile = str_replace($search, $replace, $envFileContent);

        $filesystem = new Filesystem();
        $filesystem->dumpFile($directory . "/.env", $newEnvFile);
    }
}
