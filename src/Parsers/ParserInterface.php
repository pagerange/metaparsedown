<?php

/**
* Parser Interface for Pagerange\Markdown\MetaParsedown parsers
* @author Steve George <steve@pagerange.com>
* @created 2017-10-29
* @updated 2017-11-15
* @license MIT
*/

namespace Pagerange\Markdown\Parsers;

interface ParserInterface
{
	
	/**
	 * Wrapper for erusev/parsedown method.
	 * Strips meta data from markdown
	 * Passes clean markdown to parent
	 * Returns HTML
	 * @param String $text Markdown
	 * @return String HTML
	 */
	public function text($text);

	/**
	 * Extracts meta data from markdown
	 * Parses extracted meta data string
	 * Returns array of meta data
	 * @param String $text Markdown with 
	 * @return Array
	 */
	public function meta($text);

	/**
	 * Returns markdown without meta tag block
	 * @param  String $text markdown including meta tag block
	 * @return String Markdown without meta tag block
	 */
	public function stripMeta($text);

}