#file {{$subDomain}}.se.conf
<Directory /var/www/{{$rootPath}}/public_html>
        Require all granted
	Options Indexes FollowSymLinks
	AllowOverride All
</Directory>
<VirtualHost *:80>

	# The ServerName directive sets the request scheme, hostname and port that
	# the server uses to identify itself. This is used when creating
	# redirection URLs. In the context of virtual hosts, the ServerName
	# specifies what hostname must appear in the request's Host: header to
	# match this virtual host. For the default virtual host (this file) this
	# value is not decisive as it is used as a last resort host regardless.
	# However, you must set it for any further virtual host explicitly.
	#ServerName www.example.com
	ServerName {{$subDomain}}.se
	ServerAlias www.{{$subDomain}}.se
	ServerAdmin trygve.botnen@gmail.com
	DocumentRoot /var/www/{{$rootPath}}/public_html

	# Available loglevels: trace8, ..., trace1, debug, info, notice, warn,
	# error, crit, alert, emerg.
	# It is also possible to configure the loglevel for particular
	# modules, e.g.
	#LogLevel info ssl:warn

	ErrorLog  /var/www/{{$rootPath}}/logs/error.log
   CustomLog /var/www/{{$rootPath}}/logs/access.log combined
	
	# For most configuration files from conf-available/, which are
	# enabled or disabled at a global level, it is possible to
	# include a line for only one particular virtual host. For example the
	# following line enables the CGI configuration for this host only
	# after it has been globally disabled with "a2disconf".
	#Include conf-available/serve-cgi-bin.conf
RewriteEngine on
RewriteCond %{SERVER_NAME} ={{$subDomain}}.se [OR]
RewriteCond %{SERVER_NAME} =www.{{$subDomain}}.se
RewriteRule ^ https://%{SERVER_NAME}%{REQUEST_URI} [END,NE,R=permanent]
</VirtualHost>

# vim: syntax=apache ts=4 sw=4 sts=4 sr noet
