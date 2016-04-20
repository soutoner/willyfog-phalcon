<?php

use Phalcon\Events\Manager;

// Create a events manager
$eventsManager = new Manager();
// Listen all the application events
$eventsManager->attach('micro', function ($event, $app) {
    if ($event->getType() == 'beforeHandleRoute') {
        $excluded_routes = ['/v1/token'];
        $route = $app->request->getURI();
        // Handle a request to a resource and authenticate the access token
        if (!in_array($route, $excluded_routes) &&
            !$app->oauth2->verifyResourceRequest(OAuth2\Request::createFromGlobals())) {
            \App\Http\Response::createFromOAuth($app->oauth2->getResponse())->send();

            return false;
        }

        return true;
    }
});

// Bind the events manager to the app
//$app->setEventsManager($eventsManager);

/**
 * Mount routes collections.
 */
$collections = \App\Collections\Routes::getRoutes();
foreach ($collections as $collection) {
    $app->mount($collection);
}

$app->notFound(function () use ($app) {
    return new \App\Http\Response('This is crazy, but this endpoint is not useful!', 404, 'Not Found');
});
