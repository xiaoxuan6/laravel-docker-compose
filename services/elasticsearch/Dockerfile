FROM elasticsearch:7.17.6

ADD ./plugins/elasticsearch-analysis-ik-7.17.6.zip /usr/share/elasticsearch/plugins

RUN cd /usr/share/elasticsearch/plugins \
    && unzip -o elasticsearch-analysis-ik-7.17.6.zip -d ik \
    && rm -rf elasticsearch-analysis-ik-7.17.6.zip \
