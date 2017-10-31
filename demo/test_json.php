<?php

require __DIR__ . '/../vendor/autoload.php';

use Pagerange\Markdown\MetaParsedown;  

try {

	$mp = new MetaParsedown('json'); // json parser doesn't exist

	$meta = $mp->meta($text);
	echo $mp->text($text);
	echo '<hr />';
	echo '<pre>';
	print_r($meta);
	echo '</pre>';

} catch (Exception $e) {

	echo "<p>" . $e->getMessage() . "</p>";

}


