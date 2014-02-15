<?php

namespace Builder;

require_once 'Bob/AppBootstrapBuilder.php';
require_once 'Bob/AppControllerBuilder.php';
require_once 'Bob/ControllerBuilder.php';
require_once 'Bob/ControllerCoreBuilder.php';
require_once 'Bob/DbBuilder.php';
require_once 'Bob/DBMigrationBuilder.php';
require_once 'Bob/RepositoryBuilder.php';
require_once 'Bob/RepositoryCoreBuilder.php';
require_once 'Bob/TravisBuilder.php';
require_once 'config/Repo.php';

use Bob\ControllerBuilder;
use Bob\ControllerCoreBuilder;
use Bob\RepositoryCoreBuilder;
use Bob\RepositoryBuilder;
use Bob\DbBuilder;
use Bob\DBMigrationBuilder;
use Bob\TravisBuilder;
use Bob\AppControllerBuilder;
use Bob\AppBootstrapBuilder;

use config\Repo;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class BundleCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('generate:bundle')
            ->setDescription('Generate a bundle')
            ->addArgument(
                'name',
                InputArgument::OPTIONAL,
                'What class do you want to generate?'
            )
            ->addArgument(
                'properties',
                InputArgument::IS_ARRAY,
                'What are the properties of the class?'
            )
            ->addOption(
                'reflect',
                null,
                InputOption::VALUE_NONE,
                'If set, the task will reflect what the input was'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $className = $input->getArgument('name');
        $properties = $input->getArgument('properties');
        $entityList = array($className);

        foreach($properties as $property)
        {
            explode(':', $property);
        }

        $propertiesKeysValues = array();
        foreach ($properties as $pair) {
            list($key,$value) = explode(':', $pair);
            $propertiesKeysValues[$key]=str_replace(':','', $value);
        }

        $repo = new Repo();
        $config = $repo->config;
        $dir = __DIR__.'/../src/';
        $entitiesExist = $repo->getExistingClasses($dir);
        $allEntities    = array_merge($entitiesExist, $entityList);

        $bobCoreController = new ControllerCoreBuilder($allEntities, $config, $className);
        $bobController = new ControllerBuilder($allEntities, $config, $className);
        $bobCoreRepository = new RepositoryCoreBuilder($allEntities, $config, $className);
        $bobCoreRepository = new RepositoryBuilder($allEntities, $config, $className);
        $bobDbFile = new DbBuilder($allEntities);
        $bobDbMigrationFile = new DBMigrationBuilder($className, $propertiesKeysValues);
        $bobTravisFile = new TravisBuilder($allEntities);
        $bobAppControllerFile = new AppControllerBuilder($allEntities);
        $bobAppBootstrapFile = new AppBootstrapBuilder($allEntities);

        if ($input->getOption('reflect')) {
            print_r($className, $propertiesKeysValues);
        }
    }
}