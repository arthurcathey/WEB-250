<?php
require_once 'autoload.php';

$bird = new Bird(['commonName' => 'Acadian Flycatcher']);

echo $bird->commonName;
