<?php

/**
 * Used to define the routes in the system.
 *
 * A route should be defined with a key matching the URL and an
 * controller#action-to-call method. E.g.:
 *
 * '/' => 'index#index',
 * '/calendar' => 'calendar#index'
 */
$routes = array(
  '/' => 'task#index',
  '/task/create' => 'task#create',
  '/task/destroy/:id' => 'task#destroy',
  '/task/:id' => 'task#show',
  '/task/edit/:id' => 'task#edit',
  '/test' => 'test#index'
);
