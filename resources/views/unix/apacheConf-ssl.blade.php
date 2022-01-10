# file:{{$subDomain}}.se.conf
<IfModule mod_ssl.c>
   <VirtualHost *:80> 
     ServerName {{$subDomain}}.se
     Redirect permanent / https://{{$subDomain}}.se/
   </VirtualHost>
   <VirtualHost *:443>

      ServerName {{$subDomain}}.se
      Protocols h2 http/1.1
      ServerAdmin trygve.botnen@gmail.com
      <If "%{HTTP_HOST} == 'www.{{$subDomain}}.se'">
        Redirect permanent / https://{{$subDomain}}.se/
      </If>
      DocumentRoot /var/www/{{$rootPath}}/public_html

      # Available loglevels: trace8, ..., trace1, debug, info, notice, warn,
      # error, crit, alert, emerg.
      # It is also possible to configure the loglevel for particular
      # modules, e.g.
      #LogLevel info ssl:warn

      ErrorLog  /var/www/{{$rootPath}}/logs/error.log
      CustomLog /var/www/{{$rootPath}}/logs/access.log combined

Include /etc/letsencrypt/options-ssl-apache.conf

   SSLCertificateFile /etc/letsencrypt/live/{{$subDomain}}.se/fullchain.pem
   SSLCertificateKeyFile /etc/letsencrypt/live/{{$subDomain}}.se/privkey.pem
   </VirtualHost>
   # vim: syntax=apache ts=4 sw=4 sts=4
   </VirtualHost>
</IfModule>
