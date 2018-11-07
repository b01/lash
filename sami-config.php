<?php
/**
 * https://github.com/FriendsOfPHP/Sami
 */
// Run: sami.phar update /code/lash/sami-config.php

use Sami\Sami;
use Symfony\Component\Finder\Finder;

$options = [
    'title' => 'Lash API',
    'build_dir' => __DIR__.'/docs',
    'cache_dir' => __DIR__.'/cache',
    'default_opened_level' => 2,
];

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->in('/code/lash/src');

return new Sami($iterator, $options);