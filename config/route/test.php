<?php
/**
 * Routes for test
 */
/**
 * Testroute
 */
$app->router->add("test/test", function () use ($app) {
    // Add views to a specific region
    $app->view->add("test/test");
    // Render a standard page using layout
    $app->renderPage([
        "title" => "Testpage",
    ]);
});
