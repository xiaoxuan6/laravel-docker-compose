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

namespace App\Bootstraps;

use Illuminate\Support\Collection;
use Vinhson\Search\Exceptions\RuntimeException;
use Symfony\Component\Process\{ExecutableFinder, Process};

class Composer
{
    /**
     * @throws RuntimeException
     */
    public static function load()
    {
        $git = (new ExecutableFinder())->find('git');

        if (is_null($git)) {
            throw new RuntimeException("无法获取 git 安装路径");
        }

        $commands = new Collection();
        $wget = str_replace('git.EXE', 'wget.exe', $git);
        if (! file_exists($wget)) {
            $commands->push(...['echo "Install wget"', 'search i wget -s true']);
        }

        $make = str_replace('git.EXE', 'make.exe', $git);
        if(! file_exists($make)) {
            $commands->push(...['echo "Install make"', 'search i make -s true']);
        }

        if($commands) {
            $process = Process::fromShellCommandline($commands->join(' && '));
            $process->setTimeout(300);
            $process->run(function ($type, $line) {
                echo $line;
            });
        }
    }
}
