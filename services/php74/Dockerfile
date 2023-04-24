FROM php:7.4-fpm-alpine

ENV TZ=Asia/Shanghai
ADD https://ghproxy.com/https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN apk --no-cache add tzdata ca-certificates \
  && ln -snf /usr/share/zoneinfo/$TZ /etc/localtime \
  && echo $TZ > /etc/timezone \
  && chmod +x /usr/local/bin/install-php-extensions \
  && install-php-extensions zip \
    mysqli \
    redis \
    pdo_mysql

# 安装 supervisor
COPY ./supervisord.conf /etc/supervisord.conf
ADD ./supervisord.d /etc/supervisord.d

ARG INSTALL_SUPERVISOR=false
RUN if [ $INSTALL_SUPERVISOR = true ]; then \
    apk add supervisor; \
  fi

# 安装 cron
ADD ./cron /etc/crontabs
ARG INSTALL_CRON=false
RUN if [ $INSTALL_CRON = true ]; then \
    apk add dcron; \
  fi

EXPOSE 9001
ENV START_SUPERVISOR=$INSTALL_SUPERVISOR \
  START_CRON=$INSTALL_CRON
ADD ./start.sh /app/start.sh
RUN chmod +x /app/start.sh
CMD ["/app/start.sh"]
