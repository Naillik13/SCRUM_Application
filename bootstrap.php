<?php
/**
 * Created by PhpStorm.
 * User: timotheecorrado
 * Date: 06/12/2017
 * Time: 16:41
 */

require __DIR__."/vendor/autoload.php";
$params = require __DIR__."/parameters.php";

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths = array(__DIR__."/Entity");
$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, null, null, false);
$entityManager = EntityManager::create($params['db'], $config);

$loader = new Twig_Loader_Filesystem(__DIR__.'/template');
$twig = new Twig_Environment($loader, array(
    'cache' => false,
));


session_start();