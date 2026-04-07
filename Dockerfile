FROM wordpress:latest

# Copy theme files into the WordPress themes directory
COPY . /var/www/html/wp-content/themes/mono-archive/

# Remove non-theme files from the theme directory
RUN rm -f /var/www/html/wp-content/themes/mono-archive/Dockerfile \
    && rm -f /var/www/html/wp-content/themes/mono-archive/push-to-github.sh \
    && rm -f /var/www/html/wp-content/themes/mono-archive/.DS_Store \
    && rm -rf /var/www/html/wp-content/themes/mono-archive/.git

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html/wp-content/themes/mono-archive

# Railway uses PORT env variable
EXPOSE 80
