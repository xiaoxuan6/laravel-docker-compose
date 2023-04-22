FROM rabbitmq:management

ADD https://ghproxy.com/https://github.com/rabbitmq/rabbitmq-delayed-message-exchange/releases/download/3.11.1/rabbitmq_delayed_message_exchange-3.11.1.ez /plugins

RUN rabbitmq-plugins enable rabbitmq_management rabbitmq_delayed_message_exchange
