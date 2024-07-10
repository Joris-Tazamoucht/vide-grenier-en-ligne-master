#!/bin/bash

# Récupérer les derniers changements de la branche prod depuis le dépôt Git
echo "Récupération des derniers changements de la branche prod..."
git pull origin main

# Arrêter et supprimer les conteneurs existants pour l'environnement de prod
echo "Arrêt et suppression des conteneurs existants..."
docker-compose -f docker-compose-prod.yml -p prod down

# Supprimer les conteneurs Docker orphelins
echo "Suppression des conteneurs Docker orphelins..."
docker container prune -f

# Supprimer les images Docker orphelines
echo "Suppression des images Docker orphelines..."
docker image prune -a -f

# Supprimer les volumes Docker orphelins
echo "Suppression des volumes Docker orphelins..."
docker volume prune -f

# Supprimer les volumes spécifiques à votre projet s'ils sont nommés
echo "Suppression des volumes spécifiques à votre projet..."
docker volume rm -f $(docker volume ls -qf "name=prod_*")

# Reconstruire les images Docker au besoin pour l'environnement de prod
echo "Reconstruction des images Docker..."
docker-compose -f docker-compose-prod.yml -p prod build --no-cache

# Démarrer les nouveaux conteneurs pour l'environnement de prod
echo "Démarrage des nouveaux conteneurs..."
docker-compose -f docker-compose-prod.yml -p prod up -d

echo "Déploiement de prod terminé."

# Vérification des journaux
echo "Vérification des journaux des conteneurs..."
docker-compose -f docker-compose-prod.yml -p prod logs
