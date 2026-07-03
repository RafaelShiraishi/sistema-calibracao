FROM php:8.2-apache

# Instala a extensão do banco de dados
RUN docker-php-ext-install mysqli

# Faz o Apache ler a porta dinâmica do Railway automaticamente
RUN sed -i 's/80/${PORT}/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

# Copia os seus arquivos para dentro do servidor
COPY . /var/www/html/
