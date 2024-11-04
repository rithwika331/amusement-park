# Use the official PHP image as the base image
FROM php:8.0-apache

# Copy project files to the Apache root directory
COPY . /var/www/html/

# Expose port 80 to the outside
EXPOSE 80

# Set the correct permissions
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

# Enable Apache mod_rewrite if your app uses it
RUN a2enmod rewrite

# Start Apache in the foreground
CMD ["apache2-foreground"]
