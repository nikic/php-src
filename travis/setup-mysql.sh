#!/bin/bash
sudo mysql -e 'CREATE USER "travis"@"localhost" IDENTIFIED BY ""'
sudo mysql -e 'GRANT ALL PRIVILEGES ON *.* TO "travis"@"localhost"'
mysql -e "CREATE DATABASE IF NOT EXISTS test"
