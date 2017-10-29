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

class MetaParsedown extends \Parsedown
{

	/**
	 * @var String regex for docmeta block
	 */
	private $docmetaRegex = '/(<\!--docmeta(?s)(.*?)-->)/i';


	/**
	 * Returns HTML from Markdown, but with all docmeta
	 * information stripped out.
	 * @param String $text Markdown text
	 * @return String HTML
	 */
	public function noMeta($text)
	{
		$markup = $this->text($text);
		return preg_replace($this->docmetaRegex, '', $markup);
	}

	/**
	 * Returns an array of docmeta tags from the document
	 * @param String $text Markdown text
	 * @return array or false if not docmeta tags
	 */
	public function meta($text) {
		preg_match($this->docmetaRegex, $text, $matches);
		if(isset($matches[2])) {
			return parse_ini_string($matches[2]);
		}
		return array();
	}

}
