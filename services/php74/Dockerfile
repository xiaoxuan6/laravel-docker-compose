FROM php:7.4-fpm-alpine

ENV TZ=Asia/Shanghai

RUN docker-php-source extract \
  && curl -L -o /tmp/reids.tar.gz https://codeload.github.com/phpredis/phpredis/tar.gz/5.0.2 \
  && ( \
      cd /tmp \
      && tar -xzf reids.tar.gz \
      && mv phpredis-5.0.2 /usr/src/php/ext/phpredis \
      && docker-php-ext-install phpredis mysqli pdo pdo_mysql \
  ) \
  && rm -rf /tmp/reids.tar.gz \
  && apk --no-cache add tzdata ca-certificates \
  && ln -snf /usr/share/zoneinfo/$TZ /etc/localtime \
  && echo $TZ > /etc/timezone

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
