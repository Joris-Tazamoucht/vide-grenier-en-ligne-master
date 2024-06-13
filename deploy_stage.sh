#!/bin/bash

# Récupérer les derniers changements de la branche stage depuis le dépôt Git
git pull origin stage

# Arrêter et supprimer les conteneurs existants pour l'environnement de stage
docker-compose -f docker-compose-stage.yml -p stage down

# Reconstruire les images Docker au besoin pour l'environnement de stage
docker-compose -f docker-compose-stage.yml -p stage build

# Démarrer les nouveaux conteneurs pour l'environnement de stage
docker-compose -f docker-compose-stage.yml -p stage up -d

echo "Déploiement de stage terminé."
