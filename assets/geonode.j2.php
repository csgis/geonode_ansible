WSGIDaemonProcess geonode python-path={{ install_root }}/{{name_of_project }}:{{ install_root }}/.venv/{{name_of_project }}/lib/python2.7/site-packages user=www-data threads=15 processes=2

<VirtualHost *:80>
    ServerName http://{{server_name }}
    ServerAdmin webmaster@{{server_name }}
    DocumentRoot {{ install_root }}/{{name_of_project }}/{{name_of_project }}

    LimitRequestFieldSize 32760
    LimitRequestLine 32760

    ErrorLog /var/log/apache2/error.log
    LogLevel warn
    CustomLog /var/log/apache2/access.log combined

    WSGIProcessGroup geonode
    WSGIPassAuthorization On
    WSGIScriptAlias / {{ install_root }}/{{name_of_project }}/{{name_of_project }}/wsgi.py

    Alias /static/ {{ install_root }}/{{name_of_project }}/{{name_of_project }}/static_root/
    Alias /uploaded/ {{ install_root }}/{{name_of_project }}/{{name_of_project }}/uploaded/

    <Directory "{{ install_root }}/{{name_of_project }}/{{name_of_project}}/">
         <Files wsgi.py>
             Order deny,allow
             Allow from all
             Require all granted
         </Files>

        Order allow,deny
        Options Indexes FollowSymLinks
        Allow from all
        IndexOptions FancyIndexing
    </Directory>

    <Directory "{{ install_root }}/{{name_of_project }}/{{name_of_project }}/static_root/">
        Order allow,deny
        Options Indexes FollowSymLinks
        Allow from all
        Require all granted
        IndexOptions FancyIndexing
    </Directory>

    <Directory "{{ install_root }}/{{name_of_project }}/{{name_of_project }}/uploaded/thumbs/">
        Order allow,deny
        Options Indexes FollowSymLinks
        Allow from all
        Require all granted
        IndexOptions FancyIndexing
    </Directory>

    <Directory "{{ install_root }}/{{name_of_project }}/{{name_of_project }}/uploaded/avatars/">
        Order allow,deny
        Options Indexes FollowSymLinks
        Allow from all
        Require all granted
        IndexOptions FancyIndexing
    </Directory>

    <Directory "{{ install_root }}/{{name_of_project }}/{{name_of_project }}/uploaded/people_group/">
        Order allow,deny
        Options Indexes FollowSymLinks
        Allow from all
        Require all granted
        IndexOptions FancyIndexing
    </Directory>

    <Directory "{{ install_root }}/{{name_of_project }}/{{name_of_project }}/uploaded/group/">
        Order allow,deny
        Options Indexes FollowSymLinks
        Allow from all
        Require all granted
        IndexOptions FancyIndexing
    </Directory>

    <Directory "{{ install_root }}/{{name_of_project }}/{{name_of_project }}/uploaded/documents/">
        Order allow,deny
        Options Indexes FollowSymLinks
        Deny from all
        Require all granted
        IndexOptions FancyIndexing
    </Directory>

    <Directory "{{ install_root }}/{{name_of_project }}/{{name_of_project }}/uploaded/layers/">
        Order allow,deny
        Options Indexes FollowSymLinks
        Deny from all
        Require all granted
        IndexOptions FancyIndexing
    </Directory>

    <Proxy *>
        Order allow,deny
        Allow from all
    </Proxy>

    ProxyPreserveHost On
    ProxyPass /geoserver http://127.0.0.1:8080/geoserver
    ProxyPassReverse /geoserver http://127.0.0.1:8080/geoserver

</VirtualHost>