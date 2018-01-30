#!/usr/bin/env bash
#/bin/bash
set -x
cd /home/ubuntu/wp-scandium-deploy
cp ../conf/wp-calcium-scandium.env /home/ubuntu/wp-scandium-deploy/.env
echo docker-compose up
docker-compose build && docker-compose up -d
