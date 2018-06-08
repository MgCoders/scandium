#/bin/bash


echo "MG custom pum coso"

cp -Rf /tmp/themes/* /var/www/wp-content/themes/

# execute apache
exec "apache2-foreground"