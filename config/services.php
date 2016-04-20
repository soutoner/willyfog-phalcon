<?php
/**
 * Services are globally registered in this file.
 *
 * @var \Phalcon\Config
 */
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework.
 */
$di = new FactoryDefault();

/**
 * Set shared config.
 */
$di->setShared('config', function () use ($config) {
    return $config;
});

/**
 * The URL component is used to generate all kind of urls in the application.
 */
$di->setShared('url', function () use ($config) {
    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);

    return $url;
});

/**
 * Database connection is created based in the parameters defined in the configuration file.
 */
$di->setShared('db', function () use ($config) {
    $dbConfig = $config->database->toArray();
    $adapter = $dbConfig['adapter'];
    unset($dbConfig['adapter']);

    $class = 'Phalcon\Db\Adapter\Pdo\\' . $adapter;

    return new $class($dbConfig);
});

/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise.
 */
$di->setShared('modelsMetadata', function () {
    return new MetaDataAdapter();
});

/**
 * Set OAuth2 server.
 */
$di->setShared('oauth2', function () use ($config) {
    $dsn = strtolower($config->database->adapter)
        . ':dbname=' . $config->database->dbname
        . ';host=' . $config->database->host;
    OAuth2\Autoloader::register();
    $storage = new OAuth2\Storage\Pdo([
        'dsn'       => $dsn,
        'username'  => $config->database->username,
        'password'  => $config->database->password,
    ]);
    $server = new OAuth2\Server($storage);
    $server->addGrantType(new OAuth2\GrantType\ClientCredentials($storage));

    return $server;
});
