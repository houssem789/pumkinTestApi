Bienvenue dans le projet de test Pumpkin !
==========================================

# Installation

## Pré-requis
    - Docker
    - Docker-compose
    - Maker (optionnel)

Pour les utilisateurs GNU/Linux, il est possible de définir le UID et le GID à utiliser par l'utilisateur `www-data` :

```sh
cat > docker-compose.override.yaml <<EOF
version: '3.7'

services:
    php-nginx:
        environment:
            WWW_DATA_GID: $(id -g)
            WWW_DATA_UID: $(id -u)
EOF
```

Pour les utilisateurs autre GNU/Linux, prévenez immédiatement.

## Démarrage

Divers commandes sont disponibles dans le Makefile. Aidez-vous de ces commandes pour démarrer le projet.

En cas d'erreur ou de blocage, n'hésitez pas de demander :)

Puis quand le projet est démarré, vous pouvez y accéder depuis : http://localhost:9000/