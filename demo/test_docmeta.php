<?php

require __DIR__ . '/../vendor/autoload.php';

use Pagerange\Markdown\MetaParsedown;  

$text = file_get_contents(__DIR__ . '/markdown/docmeta.md');

try {

	$mp = new MetaParsedown('docmeta');

	$meta = $mp->meta($text);
	echo $mp->text($text);
	echo '<hr />';
	echo '<pre>';
	print_r($meta);
	echo '</pre>';

} catch (Exception $e) {

	echo "<p>" . $e->getMessage() . "</p>";

}


