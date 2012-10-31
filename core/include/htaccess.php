<IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase <?php echo $rewrite_base, "\n"; ?>
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . index.php [L]
</IfModule>

# Try uncommenting these if you're getting errors uploading large files
# php_value post_max_size 50M
# php_value upload_max_filesize 20M
