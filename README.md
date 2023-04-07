# laravel-docker-compose

[![Latest Stable Version](https://poser.pugx.org/james.xue/laravel-docker-compose/v/stable.svg)](https://packagist.org/packages/james.xue/laraevl-docker-compose) 
[![Total Downloads](https://poser.pugx.org/james.xue/laravel-docker-compose/downloads.svg)](https://packagist.org/packages/james.xue/laraevl-docker-compose) 
[![Latest Unstable Version](https://poser.pugx.org/james.xue/laravel-docker-compose/v/unstable.svg)](https://packagist.org/packages/james.xue/laraevl-docker-compose) 
[![License](https://poser.pugx.org/james.xue/laravel-docker-compose/license.svg)](https://packagist.org/packages/james.xue/laraevl-docker-compose)

## Create Project

```shell
composer create-project james.xue/laravel-docker-compose
```

## Update docker `.env`

修改 `docker` 中 `mysql` 配置 `env`, 需要同步到项目 `env` 中，需执行：

```bash
composer env
```

## Run

启动 `docker`

```bash
docker-compose up -d
```

访问页面 `curl http://127.0.0.1`, 如果能正常表示部署成功，否则失败。

## Run migrate

执行数据库迁移

```bash
make migrate
```

## Docker Redis

如果使用 `redis` 容器，需修改 `docker-compose.yml` 将 `redis` 服务打开并重启 `docker`

## License

MIT
