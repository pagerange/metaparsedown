<?php

namespace Pagerange\Markdown;

/**
* Extends Erusev\Parsedown with ability to have
* meta data in markdown.
* @author Steve George <steve@pagerange.com>
* @created 2017-10-29
* @updated 2017-10-29
* @license MIT
*/

class MetaParsedown implements ParserInterface
{

	/**
	 * @var Pagerange\Markdown\ParserInterface
	 */
	private $parser;

	/**
	 * @var Array valid parser classes
	 */
	private $parsers = array(
		'docmeta' => 'DocmetaParsedown',
		'frontmatter' => 'FrontmatterParsedown'
	);

	/**
	 * Constructor
	 * @param String $type type of parser
	 * @return void
	 */
	public function __construct($type = 'docmeta') 
	{
		if(array_key_exists($type, $this->parsers)) {
			$class = '\\Pagerange\\Markdown\\' . $this->parsers[$type];
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
	 * Rturns HTML from markdown
	 * @param String $text markdown text
	 * @return String HTML
	 */
	public function text($text)
	{
		return $this->parser->text($text);
	}

}
