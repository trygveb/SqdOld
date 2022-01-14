#file {{$subDomain}}.conf  Generated {{$generated}}
<Directory /var/www/{{$rootPath}}/public_html>
   Require all granted
   Options Indexes FollowSymLinks
   AllowOverride All
</Directory>
<VirtualHost *:80>
   ServerName {{$subDomain}}
   ServerAlias www.{{$subDomain}}
   ServerAdmin trygve.botnen@gmail.com
   DocumentRoot /var/www/{{$rootPath}}/public_html

   ErrorLog  /var/www/{{$rootPath}}/logs/error.log
   CustomLog /var/www/{{$rootPath}}/logs/access.log combined
	
   RewriteEngine on
   RewriteCond %{SERVER_NAME} ={{$subDomain}} [OR]
   RewriteCond %{SERVER_NAME} =www.{{$subDomain}}
   RewriteRule ^ https://%{SERVER_NAME}%{REQUEST_URI} [END,NE,R=permanent]
</VirtualHost>
