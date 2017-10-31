<?php

/**
* Extends Erusev\Parsedown with ability to have
* docmeta meta data in markdown.
* @author Steve George <steve@pagerange.com>
* @created 2017-10-29
* @updated 2017-10-29
* @license MIT
*/

namespace Pagerange\Markdown\Parsers;

class DocmetaParser extends \Parsedown implements ParserInterface
{

	/**
	 * @var String regex for docmeta block
	 */
	private $regex = '/(\<\!--docmeta(?s)(.*?)--\>)/i';

	/**
	 * Strips docmeta metadata from document.
	 * Passes clean markdown to parent.
	 * Returns HTML.
	 * @param String $text Markdown text
	 * @return String HTML
	 */
	public function text($text)
	{
		$markdown = preg_replace($this->regex, '', $text);
		return parent::text($markdown);
	}

	/**
	 * Extracts docmeta metadata as string
	 * Parses extracted string as INI key/value pairs
	 * Returns array of metadata
	 * @param String $text Markdown text
	 * @return array
	 */
	public function meta($text) {
		preg_match($this->regex, $text, $matches);
		if(isset($matches[2])) {
			return parse_ini_string($matches[2]);
		}
		return array();
	}

}
