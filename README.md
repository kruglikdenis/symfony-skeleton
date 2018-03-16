# Project skeleton

## What's included

This is our day-to-day backend dev stack

 - Pre-configured PHP 7.2 FPM and CLI
 - Pre-configured Nginx 1.11
 - PostgreSQL 9.6
 - Symfony 4.0
 - Doctrine ORM 2.5
 - Behat and PhpSpec as testing frameworks

## Required software

 - Docker 1.9+
 - Docker-compose 1.6+
 - Docker-machine 0.6+

### Docker

All environment isolated from host system via Docker containers.

For understanding of how Docker works please read this articles:

 - [About Docker](http://www.wintellect.com/devcenter/paulballard/what-developers-need-to-know-about-docker)
 - [Visualizing Docker Containers and Images](http://merrigrove.blogspot.com.by/2015/10/visualizing-docker-containers-and-images.html)
 - [Docker Documentation](https://docs.docker.com/engine/misc/)
 - [Docker Compose Documentation](https://docs.docker.com/compose/)

### Shortcuts

To simplify your life, you can use shortcuts available in `docker/shortcuts` shell script. To make it even more easy to use, just add path to this directory in your `PATH` env variable (in `.bashrc` or `.bash_profile`):

```
export PATH=./docker/shortcuts:$PATH
```

By doing this, you will be able to use short versions of commands:

```bash
php                         # run command in php container
console                     # symfony console running via docker container
psql                        # connects psql to your database using containers
compose                     # shortcut for `docker-compose -p app`. This needed until docker-compose 1.7 is released.
composer                    # shortcut for running composer (with php7 in separate docker container)
phpspec                     # shortcut for running PhpSpec
behat                       # shortcut for running Behat in test environment
```

## Development

To start dev environment, just run `docker-compose up` and you are ready to go.

### Testing

To run test suites you can use `support/scripts/run_tests` script, or use phpspec/behat separately (see aliases section).

### XDebug

This projects template also includes xdebug extensions for remote debugging. To debug your application in PhpStorm you should configure remote server and [set path mapping](https://www.jetbrains.com/phpstorm/help/override-server-path-mappings-dialog.html) to `/app` directory.

In production environment xdebug is disabled.