# Skeleton

#### Proposta

Skeleton MVC modular utilizando Componentes do Respect


#### Preparar Ambiente

Criar um vhost (exemplo apache):

    <VirtualHost *:80>
  
      ServerName "skeleton.local"
      DocumentRoot "/caminho_do_projeto/skeleton/"
    
      <Directory "/caminho_do_projeto/skeleton">
          Options -Indexes FollowSymLinks
          AllowOverride All
          Order Allow,Deny # <-- apache 2.2
          # Require all granted # <- apache 2.4
          
          RewriteEngine On
          RewriteCond %{REQUEST_FILENAME} !-f
          RewriteCond %{REQUEST_FILENAME} !-d
          RewriteRule !(css|js|jpg|png) index.php [L]
    </Directory>        
        
      CustomLog /caminho_dos_logs/skeleton-access_log combined
      ErrorLog /caminho_dos_logs/skeleton-error_log
    </VirtualHost>

Criar o host na sua máquina:

    127.0.0.1 skeleton.local

Instalar o composer.phar: 

<https://getcomposer.org/doc/00-intro.md#downloading-the-composer-executable>

    $ curl -sS https://getcomposer.org/installer | php

##### Composer.json

Utilizamos composer para carregar os projetos que vamos usar

* [Respect/Rest](http://github.com/Respect/Rest)
* [Respect/Validation](http://github.com/Respect/Validation)
* [Respect/Relational](http://github.com/Respect/Relational)
* [Respect/Config](http://github.com/Respect/Config)

#### Install

* Rodar o php composer.phar install no diretório do projeto

#### Refs

* Ver palestra <http://www.slideshare.net/ivanrosolen/restbeer>
* Manual Respect/Rest em português <http://www.cssexperts.net/respect-rest-docs-br/>
* Mais docs <http://respect.li/>
