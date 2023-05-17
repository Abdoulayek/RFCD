# Utilisez une image de base Symfony avec PHP
FROM php:7.4-apache

# Copiez les fichiers du projet dans le conteneur
COPY . /var/www/html

# Installez les dépendances de PHP
RUN docker-php-ext-install pdo_mysql

# Exposez le port Apache
EXPOSE 80

# Démarrez le serveur Apache
CMD ["apache2-foreground"]
