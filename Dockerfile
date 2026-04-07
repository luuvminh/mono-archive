FROM wordpress:latest

# Add custom entrypoint wrapper that fixes Apache MPM at runtime
COPY docker-entrypoint-wrapper.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint-wrapper.sh

# Copy theme files into the WordPress themes directory
COPY . /var/www/html/wp-content/themes/mono-archive/

# Remove non-theme files from the theme directory
RUN rm -f /var/www/html/wp-content/themes/mono-archive/Dockerfile \
    && rm -f /var/www/html/wp-content/themes/mono-archive/.dockerignore \
    && rm -f /var/www/html/wp-content/themes/mono-archive/docker-entrypoint-wrapper.sh \
    && rm -f /var/www/html/wp-content/themes/mono-archive/push-to-github.sh \
    && rm -f /var/www/html/wp-content/themes/mono-archive/.DS_Store \
    && rm -rf /var/www/html/wp-content/themes/mono-archive/.git

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html/wp-content/themes/mono-archive

# Use wrapper entrypoint that fixes MPM before calling WordPress entrypoint
ENTRYPOINT ["docker-entrypoint-wrapper.sh"]
CMD ["apache2-foreground"]

EXPOSE 80
