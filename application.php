#!/usr/bin/env php
<?php

require __DIR__.'/vendor/autoload.php';

use DAG\OneSky\Command\DownloadFileCommand;
use DAG\OneSky\Command\UploadFileCommand;
use Symfony\Component\Console\Application;

$application = new Application(
    'Synchronize flavours strings files with OneSky',
    '@package_version@'
);
$application->add(new UploadFileCommand());
$application->add(new DownloadFileCommand());
$application->run();
