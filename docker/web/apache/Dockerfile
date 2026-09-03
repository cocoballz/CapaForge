FROM httpd:2.4-alpine

RUN sed -i 's/^#LoadModule proxy_module/LoadModule proxy_module/' conf/httpd.conf \
    && sed -i 's/^#LoadModule proxy_fcgi_module/LoadModule proxy_fcgi_module/' conf/httpd.conf \
    && sed -i 's%^#Include conf/extra/httpd-vhosts.conf%Include conf/extra/httpd-vhosts.conf%' conf/httpd.conf \
    && echo 'ServerName localhost' >> conf/httpd.conf

COPY httpd-vhosts.conf /usr/local/apache2/conf/extra/httpd-vhosts.conf
