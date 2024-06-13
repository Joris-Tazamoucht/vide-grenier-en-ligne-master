#!/bin/bash

# Récupérer les derniers changements de la branche master depuis le dépôt Git
git pull origin master

# Arrêter et supprimer les conteneurs existants pour l'environnement de production
docker-compose -f docker-compose-prod.yml -p prod down

# Reconstruire les images Docker au besoin pour l'environnement de production
docker-compose -f docker-compose-prod.yml -p prod build

# Démarrer les nouveaux conteneurs pour l'environnement de production
docker-compose -f docker-compose-prod.yml -p prod up -d

echo "Déploiement de production terminé."
