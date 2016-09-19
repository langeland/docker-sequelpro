# Docker Sequel Pro connector
Opens Sequel Pro from the command line, based on the mysql configuration in docker-compose.yaml

## Installation
```
cd ~/bin/
git clone git@github.com:langeland/docker-sequelpro.git docker-sequelpro-source
ls -s docker-sequelpro-source/application.php docker-sequelpro
cd docker-sequelpro-source
composer install
```

## Usage
```
cd ~/Docker/MyProject
docker-sequelpro
```
### Root login
```
cd ~/Docker/MyProject
docker-sequelpro -r
```

## Requirements
For this to work there must be either a docker-compose.yaml or a docker-compose.yml file. And it must contain the following:

```
mysql:
  ports:
    - "3306:3306"
  environment:
    MYSQL_ROOT_PASSWORD: password
    MYSQL_USER: rbareg_user
    MYSQL_PASSWORD: rbareg_password
    MYSQL_DATABASE: rbareg_database
```