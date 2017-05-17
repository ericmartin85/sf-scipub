<?php

use Symfony\Component\Yaml\Yaml;

require __DIR__ . '/../vendor/autoload.php';

$test = 'Super categorie';
echo preg_replace('~[^a-z0-9]+~', '-', strtolower($test));

exit();

$yaml = <<<EOT
blog_list:
    path: /blog/list
    defaults: { _controller: BlogBundle:Blog:list }

blog_detail:
    path: /blog/{slug}
    defaults: 
        _controller: BlogBundle:Blog:detail
EOT;

$result = Yaml::parse($yaml);

header('Content-type: text/plain');
echo var_export($result);

$config = array(
    'blog_list' => array(
        'path' => '/blog/list',
        'defaults' => array(
            '_controller' => 'BlogBundle:Blog:list',
        ),
    ),
    'blog_detail' => array(
        'path' => '/blog/{slug}',
        'defaults' => array(
            '_controller' => 'BlogBundle:Blog:detail',
        ),
    ),
);