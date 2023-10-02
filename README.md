# nail360UserLight
# .htaccess
```
RewriteEngine On
RewriteRule ^(inc|react)/.*$ index.php
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^(.*)$ index.php [QSA,L]
```