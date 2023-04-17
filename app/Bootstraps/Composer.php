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

        $wget = str_replace('git.EXE', 'wget.exe', $git);
        if (! file_exists($wget)) {
            throw new RuntimeException("wget 命令不存在，参考地址：https://www.jianshu.com/p/fb6601795011");
        }

        $make = str_replace('git.EXE', 'make.exe', $git);
        if(! file_exists($make)) {
            throw new RuntimeException("make 命令不存在，参考地址：https://github.com/xiaoxuan6/static/releases/download/v1.0.0.beta/make.exe");
        }
    }
}
