FROM elasticsearch:7.17.6

ADD https://ghproxy.com/https://github.com/medcl/elasticsearch-analysis-ik/releases/download/v7.17.6/elasticsearch-analysis-ik-7.17.6.zip /usr/share/elasticsearch/plugins

RUN cd /usr/share/elasticsearch/plugins \
    && unzip -o elasticsearch-analysis-ik-7.17.6.zip -d ik \
    && rm -rf elasticsearch-analysis-ik-7.17.6.zip \
