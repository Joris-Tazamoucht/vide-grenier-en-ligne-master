#!/bin/bash

# Récupérer les derniers changements de la branche stage depuis le dépôt Git
echo "Récupération des derniers changements de la branche stage..."
git pull origin stage

# Arrêter et supprimer les conteneurs existants pour l'environnement de stage
echo "Arrêt et suppression des conteneurs existants..."
docker-compose -f docker-compose-stage.yml -p stage down

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
docker volume rm -f $(docker volume ls -qf "name=stage_*")

# Reconstruire les images Docker au besoin pour l'environnement de stage
echo "Reconstruction des images Docker..."
docker-compose -f docker-compose-stage.yml -p stage build --no-cache

# Démarrer les nouveaux conteneurs pour l'environnement de stage
echo "Démarrage des nouveaux conteneurs..."
docker-compose -f docker-compose-stage.yml -p stage up -d

echo "Déploiement de stage terminé."

# Vérification des journaux
echo "Vérification des journaux des conteneurs..."
docker-compose -f docker-compose-stage.yml -p stage logs
