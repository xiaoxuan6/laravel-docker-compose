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

use TitasGailius\Terminal\Terminal;
use Symfony\Component\Process\ExecutableFinder;
use Vinhson\Search\Exceptions\RuntimeException;

class Composer
{
    /**
     * @throws RuntimeException
     */
    public static function loadMake()
    {
        $git = (new ExecutableFinder())->find('git');

        if (is_null($git)) {
            throw new RuntimeException("无法获取 git 安装路径");
        }

        $make = str_replace('git.EXE', 'make.exe', $git);
        if(! file_exists($make)) {
            $response = Terminal::builder()
                ->run('search i make');

            $response->output();
        }
    }
}
