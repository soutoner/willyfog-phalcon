# willyfog

[![Build Status](https://travis-ci.org/soutoner/willyfog.svg?branch=master)](https://travis-ci.org/soutoner/willyfog)

![Willy Fog](docs/willy-fog.jpg "Willy Fog")

API for end-of-degree project for ERASMUS. This will serve an application to simplify
the process of setting equivalences between subjects of different universities.

<!-- START doctoc generated TOC please keep comment here to allow auto update -->
<!-- DON'T EDIT THIS SECTION, INSTEAD RE-RUN doctoc TO UPDATE -->
**Table of Contents**  *generated with [DocToc](https://github.com/thlorenz/doctoc)*

- [Vagrant environment](#vagrant-environment)
  - [Requirements](#requirements)
  - [Steps](#steps)
- [Deployment](#deployment)
- [Run test](#run-test)
- [Development](#development)
  - [Migrations](#migrations)
    - [Create migration](#create-migration)
    - [Run migrations](#run-migrations)
  - [Seeds](#seeds)
    - [Create seeder](#create-seeder)
    - [Run seeding](#run-seeding)
  - [Others](#others)
    - [Enable PHPStorm debugging](#enable-phpstorm-debugging)
    - [Easier domain name](#easier-domain-name)
    - [Integrate PHPStorm with Phalcon](#integrate-phpstorm-with-phalcon)

<!-- END doctoc generated TOC please keep comment here to allow auto update -->

# Vagrant environment

## Requirements

* Operating System: Windows, Linux, or OSX.
* Virtualbox >= 4.3.10
* Vagrant >= 1.4.1

## Steps

[Phalcon/Vagrant repository](https://github.com/phalcon/vagrant)

First you need a Git enabled terminal. Then you should clone this repository locally.

`$ git clone https://github.com/phalcon/vagrant.git`

For newer versions of Vagrant and VirtualBox you may need guest additions, so install the plugin:

```
# For Linux/OSX
$ vagrant plugin install vagrant-vbguest

# For Windows
$ vagrant plugin install vagrant-windows
```

Note: if instalation fails during `guest additions`, exec:

`sudo apt-get install zlib1g-dev`

# Deployment

```
vagrant up # if it's not made
vagrant ssh
cd /var/www/willyfog
mv config/.env.example config/.env
composer install
```

# Run test

This will take care of creating the test database (inside `config.php`), seeding it, and run the tests.

```
cd /var/www/willyfog
sudo php vendor/bin/codecept run
```

# Development

## Migrations

### Create migration

```
cd /var/www/willyfog
php vendor/bin/phinx create <MigrationName>
```

### Run migrations

```
cd /var/www/willyfog
php app/cli.php migrate
```

## Seeds

### Create seeder

```
cd /var/www/willyfog
php vendor/bin/phinx seed:create <Model>Seeder
```

### Run seeding

```
cd /var/www/willyfog
# It creates database if it's not created yet
php app/cli.php seed
```

## Others

### Enable PHPStorm debugging

```
# /etc/php5/apache2/conf.d/20-xdebug.ini

zend_extension=xdebug.so
xdebug.remote_enable=1
xdebug.remote_handler=dbgp
xdebug.remote_mode=req
xdebug.remote_host=<IP cliente>
xdebug.remote_port=9000
xdebug.remote_autostart=1
```

Note that you will have to uncomment the first line, as XDebug is disabled
by default because of major impact on composer.

### Easier domain name

While developing (remember to edit with `sudo`):

```
# /etc/hosts
...
192.168.50.4    api.willyfog.com
...
```

So you will be able to enter `http://api.willyfog.com/` and you will reach the server.

### Integrate PHPStorm with Phalcon

```
git clone https://github.com/phalcon/phalcon-devtools ~/phalcon-devtools
```

Go to `Settings > Languages & Frameworks > PHP` and inside `Include Path` add the path
`~/phalcon-devtools/phalcon/devtools/ide/<version de phalcon>`
