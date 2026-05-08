<?php

use shop\Router;

Router::add('^admin/?$', ['controller' => 'Main', 'action' => 'index', 'admin_prefix' => 'admin']);
Router::add('^admin/(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', ['admin_prefix' => 'admin']);

Router::add('^product/(?P<slug>[a-z0-9-]+)/?$', ['controller' => 'Product', 'action' => 'view']);
Router::add('^category/(?P<slug>[a-z0-9-]+)/?$', ['controller' => 'Category', 'action' => 'view']);
Router::add('^brand/(?P<slug>[a-z0-9-]+)/?$', ['controller' => 'Brand', 'action' => 'view']);
Router::add('^catalog?$', ['controller' => 'Catalog', 'action' => 'view']);
Router::add('^subcatalog/(?P<slug>[a-z0-9-]+)/?$', ['controller' => 'Subcatalog', 'action' => 'view']);

Router::add('^search/?$', ['controller' => 'Search', 'action' => 'index']);
Router::add('^page/(?P<slug>[a-z0-9-]+)/?$', ['controller' => 'Page', 'action' => 'view']);
Router::add('^about?$', ['controller' => 'About', 'action' => 'view']);
Router::add('^reviews?$', ['controller' => 'Reviews', 'action' => 'view']);
Router::add('^congratulation/?$', ['controller' => 'Congratulation', 'action' => 'index']);
                            
Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/(?P<action>[a-z-]+)/?$');
