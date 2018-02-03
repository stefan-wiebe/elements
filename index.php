<!DOCTYPE html>
<?php
require_once 'vendor/autoload.php';

use Element\ElementFactory;

$div = ElementFactory::make('div');
$div['class'] = ['red', 'blue', 'green'];
$div['class'][] = 'yellow';
$div['id'] = 'thing';

echo $div;
print_r($div['class']);

$li = ElementFactory::make('li');
$li['class'] = 'wild snowy blue';

echo $li;
print_r($li['class']);
