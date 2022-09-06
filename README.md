# GeekLand Module Backend

## Présentation

GeekLand est un projet de site E-Commerce réalisé en collaboration avec [Remy Cuvilier](https://github.com/Kayyhan) et Michaël Cornil. 
Celui ci a été réalisé lors d'une formation développeur web et web mobile entre le 01/12/2021 et le 09/09/2022.

Le projet est divisé en deux environnement une partie [Front](https://github.com/XiliTra/GeekLandFront), et cette partie Back, le projet n'a pas pu être finalisé pendant la formation.

## Contenu

> Cette partie back est une RestAPI.

### Fonctionnalités

- Système d'authentification sécurisé.
- Simulation d'enregistrment de caarte bancaire.
- Ajout d'article commercial.
- Utilisateurs.

## Mise en place de l'environement

> Il sera important de posséder la version PHP 8.0, et Composer pour pouvoir installer l'environnement de travail.

> Attention, il est important d'avoir une base de donnée SQL ouverte
 
### Création de l'environnement

```
git clone https://github.com/XiliTra/GeekLandBack.git
cd GeekLandBack
composer install
```

- Creer un fichier nommée ".env", copier entièrement le fichier ".env.exemple".
- Remplacer ou mettre a jour les valeurs suivantes :
    - DB_HOST
    - DB_PORT
    - DB_DATABASE
    - DB_USERNAME
    - DB_PASSWORD
- Creer une base de données identique a la valeur "DB_DATABASE".

> Migration de la base de données :

```
php artisan migrate
```

Si tout ce passe correctement vous devrier pouvoir lancer le serveur de production.

> Pour lancer le serveur de production : 

```
php artisan serv
```

### Creation d'environnement de production distant

Le fichier Dockerfile permet la création d'une image docker ave un serveur Laravel.

```
docker run -d -v "/path/to/file":"/app"
```
