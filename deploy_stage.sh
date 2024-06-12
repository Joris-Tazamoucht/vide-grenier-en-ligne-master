#!/bin/bash

# Récupérer les derniers changements de la branche stage depuis le dépôt Git
git pull origin stage

# Arrêter et supprimer les conteneurs existants
docker-compose -f docker-compose.yml down

# Reconstruire les images Docker au besoin
docker-compose -f docker-compose.yml build

# Démarrer les nouveaux conteneurs
docker-compose -f docker-compose.yml up -d

echo "Déploiement terminé."
