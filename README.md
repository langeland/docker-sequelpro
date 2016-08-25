# Docker Sequel pro connector
Opens 

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

## Requirements
For this to work there must be either a docker-compose.yaml or a docker-compose.yml file. And it must contain the following:

```
mysql:
  ports:
    - "3309:3306"
  environment:
    MYSQL_ROOT_PASSWORD: password
    MYSQL_USER: rbareg_user
    MYSQL_PASSWORD: rbareg_password
    MYSQL_DATABASE: rbareg_database
```