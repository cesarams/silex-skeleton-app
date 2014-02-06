<?php

require_once __DIR__.'/../vendor/autoload.php';
require_once 'Bob/ControllerBuilder.php';
require_once 'Bob/ControllerCoreBuilder.php';

use Symfony\Component\ClassLoader\UniversalClassLoader;
use TwigGenerator\Builder\Generator;
use \Bob\ControllerBuilder;
use \Bob\ControllerCoreBuilder;

$loader = new UniversalClassLoader();

$category = 'Api_Rest_Implementation';
$organisation = 'Thinkadoo';
$author = 'Andre Venter';
$authorEmail = 'andre.n.venter@gmail.com';
$corganisationWebSite = 'http://think-a-doo.net';
$repository = 'https://github.com/thinkadoo/silex-skeleton-rest.git';

$entityList = array('User','Admin');

// Controller

foreach($entityList as $className){

    $nameSpace = $className. '\\' . $className . 'Bundle\\Controller';
    $moduleName = $className;

    $bobController = new ControllerBuilder();
    $bobController->setOutputName($className.'Controller.php');

    $bobController->setVariable('category', $category);
    $bobController->setVariable('author', $author);
    $bobController->setVariable('organisation', $organisation);
    $bobController->setVariable('organisationWebSite', $corganisationWebSite);
    $bobController->setVariable('repository', $repository);

    $bobController->setVariable('className', $className);
    $bobController->setVariable('extends', 'ControllerCore');
    $bobController->setVariable('moduleName', $moduleName);
    $bobController->setVariable('author', $author);
    $bobController->setVariable('authorEmail', $authorEmail);

    $generateController = new Generator();
    $generateController->setTemplateDirs(array(__DIR__.'/Bob/Work/ControllerTemplate/',));
    $generateController->setMustOverwriteIfExists(true);
    $generateController->setVariables(array('namespace' => $nameSpace,));

    $generateController->addBuilder($bobController);

    $generateController->writeOnDisk(__DIR__.'/../src/'.$className.'/'.$className.'Bundle/Controller');
    print_r('Done Generating Controller ;) ');

}

// ControllerCore

foreach($entityList as $className){

    $nameSpace = $className. '\\' . $className . 'Bundle\\Core';
    $moduleName = $className;

    $bobCoreController = new ControllerCoreBuilder();
    $bobCoreController->setOutputName('ControllerCore.php');

    $bobCoreController->setVariable('category', $category);
    $bobCoreController->setVariable('author', $author);
    $bobCoreController->setVariable('organisation', $organisation);
    $bobCoreController->setVariable('organisationWebSite', $corganisationWebSite);
    $bobCoreController->setVariable('repository', $repository);

    $bobCoreController->setVariable('className', $className);
    $bobCoreController->setVariable('implements', 'ControllerProviderInterface');
    $bobCoreController->setVariable('moduleName', $moduleName);
    $bobCoreController->setVariable('author', $author);
    $bobCoreController->setVariable('authorEmail', $authorEmail);

    $generateCoreController = new Generator();
    $generateCoreController->setTemplateDirs(array(__DIR__.'/Bob/Work/ControllerCoreTemplate/',));
    $generateCoreController->setMustOverwriteIfExists(true);
    $generateCoreController->setVariables(array('namespace' => $nameSpace,));

    $generateCoreController->addBuilder($bobCoreController);

    $generateCoreController->writeOnDisk(__DIR__.'/../src/'.$className.'/'.$className.'Bundle/Core');
    print_r('Done Generating Controller Core ;) ');

}