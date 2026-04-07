FROM wordpress:latest

# Remove conflicting MPM module files directly (survives entrypoint)
RUN rm -f /etc/apache2/mods-enabled/mpm_event.load /etc/apache2/mods-enabled/mpm_event.conf \
    && rm -f /etc/apache2/mods-enabled/mpm_worker.load /etc/apache2/mods-enabled/mpm_worker.conf

# Copy theme files into the WordPress themes directory
COPY . /var/www/html/wp-content/themes/mono-archive/

# Remove non-theme files from the theme directory
RUN rm -f /var/www/html/wp-content/themes/mono-archive/Dockerfile \
    && rm -f /var/www/html/wp-content/themes/mono-archive/.dockerignore \
    && rm -f /var/www/html/wp-content/themes/mono-archive/push-to-github.sh \
    && rm -f /var/www/html/wp-content/themes/mono-archive/.DS_Store \
    && rm -rf /var/www/html/wp-content/themes/mono-archive/.git

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html/wp-content/themes/mono-archive

EXPOSE 80
