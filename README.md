# Hashmag

The purpose of this repository is
* to demonstrate PHP unittests
* and use a docker-compose setup for a PHP/Database setup

My thanks go to https://github.com/JPrueger who contributed her PHP exercise as a base for this demo.

## How to use this demo

* Install [Docker](https://docs.docker.com/get-docker/)
* Install [Docker Compose](https://docs.docker.com/compose/install/)
* Clone this repository
* Copy `database.env.tmpl` to `database.env` and add a user+password
* Run `docker-compose up -d` and wait until all images are downloaded and built and all docker containers are up and running.
* open `http://localhost/` to visit the hasmag website
* open `http://localhost:8000/` to visit phpMyAdmin
* run `./run_tests.sh` to run the phpunit tests
* Run `docker-compose stop` to stop the running containers (but don't delete them)
* Run `docker-compose down` to stop and remove containers, networks, images, and volumes
* Run `docker-compose down --rmi all -v` to stop and remove containers, networks, images, and volumes

### Login data

**Of course we do not normally store login data in our git repository!!!**

#### Admin

* **E-Mail-Adresse:** admin.doe@gmail.com
* **Passwort:** Adminpassword1!

#### No Admin

* **E-Mail-Adresse:** sam.doe@gmail.com
* **Passwort:** Samdoepassword1!
