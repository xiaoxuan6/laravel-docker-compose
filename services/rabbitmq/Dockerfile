FROM rabbitmq:management

ADD ./plugins /plugins

RUN rabbitmq-plugins enable --offline rabbitmq_management rabbitmq_delayed_message_exchange
