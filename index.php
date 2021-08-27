<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require 'lib/bootstrap.php';
require 'lib/Controller.php';
require 'lib/Model.php';
require 'lib/View.php';
require 'lib/Session.php';
require 'lib/Database.php';

$bootstrap = new Bootstrap();
