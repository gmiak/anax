<?php
// Init comments
// $app->router->add("comments/**", [$app->commentController, "init"]);
// Reset and delete all comments
$app->router->get("comments/reset", [$app->commentController, "getReset"]);
// Get all comments
$app->router->get("comments", [$app->commentController, "getComments"]);
// Post a comment
$app->router->post("comment", [$app->commentController, "postComment"]);
// Get a single comment
$app->router->get("comment/{id:digit}", [$app->commentController, "getComment"]);
// Update/edit a comment
$app->router->get("comment/edit/{id:digit}", [$app->commentController, "editComment"]);
$app->router->post("comment/edit", [$app->commentController, "upsertComment"]);
// Delete a comment
$app->router->get("comment/delete/{id:digit}", [$app->commentController, "deleteComment"]);
