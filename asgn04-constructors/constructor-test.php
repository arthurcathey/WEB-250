<?php
require_once __DIR__ . '/autoload.php';

$bird = new Bird(['commonName' => 'Acadian Flycatcher']);

echo $bird->commonName;
