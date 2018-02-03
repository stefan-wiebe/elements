<?php
require_once 'vendor/autoload.php';

use Element\ElementFactory;

$elFactory = new ElementFactory();
$div = $elFactory->make('div');

$div['class'] = ['red', 'blue', 'green'];
$div['class'][] = 'yellow';
$div['id'] = 'thing';
$div['class'] = 'red';
$div['class'][] = 'blue';

unset($div['class'][1]);

echo $div;
