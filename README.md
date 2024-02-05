# API

The API will be here.

Refer to the [Getting Started Guide](https://api-platform.com/docs/distribution) for more information.

Pour demarer l'application: symfony serve

les configuration de la base de données dans le fichier .env

remplacer par le votre configuration pour comminuquer avec la base de données local

# certificat

https://github.com/lexik/LexikJWTAuthenticationBundle/blob/2.x/Resources/doc/index.rst#id15

https://www.univ-orleans.fr/iut-orleans/informatique/intra/tuto/php/symfony-securitybundle-auth.html

# api

composer req api

## creer une entity

$ php bin/console make:entity --api-resource

Il faut ensuite créer un dossier jwt dans le dossier config

Ensuite on va générer les deux clés (private et publique) en ligne de commande :

- openssl genrsa –out config/jwt/private.pem –aes256 4096
- openssl rsa –pubout –in config/jwt/private.pem –out config/jwt/public.pem

== php bin/console lexik:jwt:generate-keypair

# eliminer le certificat

symfony server:ca:uninstall

## Pour les localisationn

- composer require beberlei/doctrineextensions
-

# installation client

composer require guzzlehttp/guzzle
