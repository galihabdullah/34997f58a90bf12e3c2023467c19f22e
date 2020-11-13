FROM php:7-alpine
LABEL maintainer="Johannes Schickling <schickling.j@gmail.com>"

ADD install.sh install.sh
RUN chmod +x install.sh
RUN ./install.sh && rm install.sh

COPY config.php /source/config.php

EXPOSE 2080
CMD sh -c 'BEANSTALK_SERVERS=beanstalkd:11300 php -S 0.0.0.0:2080 -t /source/public'