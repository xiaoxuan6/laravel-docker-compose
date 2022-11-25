<?php
/**
 * This file is part of james.xue/laravel-docker-compose.
 *
 * (c) vinhson <15227736751@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vinhson\LaravelDockerCompose\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class PublishCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel-docker-compose:publish {mode?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish the docker compose files';

    protected $filename = 'docker-compose.yml';
    protected static $modes = ['dnmp', 'damp'];

    /**
     * @var array|bool|string
     */
    private $mode;

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->mode = $this->option('mode') ?? 'dnmp';

        if (in_array($this->mode, self::$modes)) {
            $this->error("Mode not support {$this->mode}, Only support dnmp/damp");
        }

        if (File::exists(app_path($this->filename))) {
            if ($this->confirm("文件 {$this->filename} 已存在，是否覆盖继续执行？", true)) {
                $this->publishDockerCompose();
            }
        } else {
            $this->publishDockerCompose();
        }
    }

    private function publishDockerCompose()
    {
        if ($this->mode == 'damp') {
            File::put(app_path('public/.htaccess'), file_get_contents(__DIR__ . '/../conf/.htaccess'));
            File::put(app_path('Dockerfile'), file_get_contents(__DIR__ . '/../conf/Dockerfile'));
            File::put(app_path('entrypoint.sh'), file_get_contents(__DIR__ . '/../conf/entrypoint.sh'));
        }

        File::put(app_path($this->filename), file_get_contents(__DIR__ . "/stubs/docker-compose-{$this->mode}.yml"));
        File::put(app_path('default.conf'), file_get_contents(__DIR__ . "/../conf/{$this->mode}-default.conf"));
    }
}
