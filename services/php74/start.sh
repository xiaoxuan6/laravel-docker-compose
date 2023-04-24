#!/bin/sh

# Start supervisor
if [ "$START_SUPERVISOR" = true ]; then
    /usr/bin/supervisord -n -c /etc/supervisord.conf &
else:
    echo "supervisor not install"
fi

# Start cron
# https://www.unix.com/man-page/centos/8/cron/
# https://manpages.ubuntu.com/manpages/trusty/man8/cron.8.html
if [ "$START_CRON" = true ]; then
    crond -f -d 8 &
fi

# Start PHP-FPM
php-fpm
