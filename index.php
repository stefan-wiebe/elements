<!DOCTYPE html>
<?php
require_once 'vendor/autoload.php';

use Element\ElementFactory;

$div = ElementFactory::make('div');
$div['class'] = ['red', 'blue', 'green'];
$div['class'][] = 'yellow';
$div['id'] = 'thing';
$div['style'] = 'display: 	 block;
 				 height:     500px;
				 background: linear-gradient(to bottom, red, blue) !important;';

echo $div;
print_r($div['class']);

$li = ElementFactory::make('li');
$li['class'] = 'wild snowy blue';
$li['style']['display'] = 'block';
$li['style']['height'] = '500px';
$li['style']['background-color'] = 'blue !important';

echo $li;
print_r($li['class']);
