#!/usr/bin/env php
<?php

if (file_exists(__DIR__ . '/Libraries/autoload.php')) {
	require __DIR__ . '/Libraries/autoload.php';
} else {
	echo 'Missing autoload.php, update by the composer.' . PHP_EOL;
	exit(2);
}

define('BASE_DIRECTORY', $_SERVER["PWD"]);
define('ROOT_DIRECTORY', __DIR__);


if(is_file(BASE_DIRECTORY . '/docker-compose.yaml')) {
	$fileExtension = 'yaml';
} elseif(is_file(BASE_DIRECTORY . '/docker-compose.yml')) {
	$fileExtension = 'yml';
} else {
	die('No docker-compose file found.');
}

$file = BASE_DIRECTORY . '/docker-compose.' . $fileExtension;
$value = \Symfony\Component\Yaml\Yaml::parse(file_get_contents($file));

if(!is_array($value['mysql'])){
	die('Cannot find a mysql container.');
}

$portmapping = explode(':', $value['mysql']['ports'][0]);

$markers = array();
if(in_array('-r', $argv)){
	$markers['###USER###'] = 'root';
	$markers['###PASSWORD###'] = $value['mysql']['environment']['MYSQL_ROOT_PASSWORD'];
} else {
	$markers['###USER###'] = $value['mysql']['environment']['MYSQL_USER'];
	$markers['###PASSWORD###'] = $value['mysql']['environment']['MYSQL_PASSWORD'];
}

$markers['###DATABASE###'] = $value['mysql']['environment']['MYSQL_DATABASE'];
$markers['###HOST###'] = '127.0.0.1';
$markers['###PORT###'] = $portmapping[0];


$spfTemplate = file_get_contents(ROOT_DIRECTORY . '/spf-template.spf');
$spfContent = str_replace(array_keys($markers), array_values($markers), $spfTemplate);
$tmpfname = tempnam("/tmp", "DOCKER_SEQUALPRO");

file_put_contents($tmpfname . '.spf', $spfContent);

exec("open " . $tmpfname . '.spf');
sleep(1);
unlink($tmpfname . '.spf');



