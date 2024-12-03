FROM php:8.4-cli

RUN apt-get update \
 && apt-get install -y --no-install-recommends git libzip-dev zlib1g-dev zip \
 && docker-php-ext-configure zip \
 && docker-php-ext-install zip \
 && pecl install xdebug \
 && docker-php-ext-enable xdebug \
 && curl -sS https://getcomposer.org/installer \
  | php -- --install-dir=/usr/local/bin --filename=composer

RUN echo "#!/bin/bash\n\n\
    iniFile=\$(php --ini | grep xdebug)\n\
    endOfIniFile=$(echo -n $iniFile | tail -c 1)\n\n\
    if [ \$(echo -n $iniFile | tail -c 1)  \",\" ];\n\
     then\n      iniFile=\${iniFile%?};\n\
    fi\n\n\
    cat <<EOF >> \$iniFile\nxdebug.mode=debug\nxdebug.client_host=\${HOST_IP}\nxdebug.client_port=9003\nxdebug.idekey=\"netbeans-xdebug\"\nxdebug.start_with_request=yes\nEOF\n\n\n/usr/bin/tail -f /dev/null" >> /tmp/start.sh \
 && chmod +x /tmp/start.sh

WORKDIR /var/www

CMD "/tmp/start.sh"
