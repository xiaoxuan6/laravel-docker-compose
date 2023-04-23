#!/bin/sh

# Start supervisor
if [ "$START_SUPERVISOR" = true ]; then
    /usr/bin/supervisord -n -c /etc/supervisord.conf &
else:
    echo "supervisor not install"
fi

# Start cron
if [ "$START_CRON" = true ]; then
    crond -f -d 8 &
fi

# Start PHP-FPM
php-fpm
