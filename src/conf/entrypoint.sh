#!/usr/bin/env bash

set -e

cd /var/www/html

echo 'generate key'
php artisan key:generate

###################### start 依赖其他容器 start ###############################
#sleep 10 # 依赖其他容器，容器启动之后无法立即链接需要等待一段时间才能正常链接（需要 dns 解析）

#echo 'migrate'
#php artisan migrate

###################### end 依赖其他容器 end ###############################

#echo "queue"
#php artisan queue:work --queue={default} --verbose --tries=3 --timeout=90 &
#php artisan queue:work --tries=3 --timeout=90

echo 'http'
exec apache2-foreground