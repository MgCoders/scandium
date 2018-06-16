#/bin/bash


echo "MG!"
rm -r /var/www/html/wp-content/themes/ 
cp -r /tmp/themes/ /var/www/html/wp-content/themes/
chown -R www-data:www-data /var/www/html/wp-content/themes
touch /var/www/html/wp-content/themes/themes-updated-`date +"%d-%m-%Y"`.log
echo "GM!"

# execute apache
exec "apache2-foreground"