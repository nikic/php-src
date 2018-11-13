#!/bin/bash
set -ex

# curl
export PHP_CURL_HTTP_REMOTE_SERVER="http://localhost:8080"
cd ./ext/curl/tests/responder
php -S localhost:8080 &
cd -

# mysql, mysqli, pdo_mysql
mysql -e "CREATE DATABASE IF NOT EXISTS test"

# pgsql, pdo_pgsql
export PDO_PGSQL_TEST_DSN='pgsql:host=localhost port=5432 dbname=test user=postgres password='
