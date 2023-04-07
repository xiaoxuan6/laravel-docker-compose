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

namespace App;

use Exception;
use App\Commands\EnvCommand;
use Symfony\Component\Console\Exception\ExceptionInterface;

class Application
{
    /**
     * @throws ExceptionInterface|Exception
     */
    public function __invoke()
    {
        $app = new \Symfony\Component\Console\Application();
        $app->add(new EnvCommand());
        $app->setDefaultCommand('run');
        $app->run();
    }
}
