FROM wordpress:latest

# Fix Apache MPM conflict (both mpm_prefork and mpm_event can't be loaded)
RUN a2dismod mpm_event 2>/dev/null; a2dismod mpm_worker 2>/dev/null; a2enmod mpm_prefork || true

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

# WordPress on Apache listens on port 80
EXPOSE 80
