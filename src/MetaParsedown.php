<?php

namespace Pagerange\Markdown;

/**
* Extends erusev/parsedown with ability to have
* meta data in markdown.  
* 
* This is just a convenience adapter for the 
* Parser classes.  
* 
* If you prefer, you can instantiate the Parser 
* classes directly and bypass this adapter completely.
* 
* @author Steve George <steve@pagerange.com>
* @created 2017-10-29
* @updated 2017-10-29
* @license MIT
*/

class MetaParsedown implements Parsers\ParserInterface
{

	/**
	 * @var Array valid parser classes
	 */
	private $parsers = array(
		'yaml' => 'YamlParser',
	);

	/**
	 * @var Pagerange\Markdown\ParserInterface
	 */
	private $parser;


	/**
	 * Constructor
	 * @param String $type type of parser
	 * @return void
	 */
	public function __construct($type = 'yaml') 
	{
		if(array_key_exists($type, $this->parsers)) {
			$class = '\\Pagerange\\Markdown\\Parsers\\' . $this->parsers[$type];
			$this->parser = new $class;
		}  else {
			throw new ParserNotFoundException('No such parser: ' . $type);
		}
	}

	/**
	 * Returns an array of the metadata contained in the markdown
	 * @param String $text  markdown text
	 * @return Array
	 */
	public function meta($text) 
	{
		return $this->parser->meta($text);
	}

	/**
	 * Returns HTML from markdown
	 * @param String $text markdown text
	 * @return String HTML
	 */
	public function text($text)
	{
		return $this->parser->text($text);
	}

	/**
	 * Returns markdown without meta tag block
	 * @param  String $text markdown including meta tag block
	 * @return String Markdown without meta tag block
	 */
	public function stripMeta($text)
	{
		return $this->parser->stripMeta($text);
	}

}
