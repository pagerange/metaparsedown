<?php

namespace Pagerange\Markdown;

/**
* Extends Erusev\Parsedown with ability to have
* YAML metadata in markdown
* @author Steve George <steve@pagerange.com>
* @created 2017-10-29
* @updated 2017-10-29
* @license MIT
*/

use \Symfony\Component\Yaml\Yaml;

class FrontmatterParsedown extends \Parsedown implements ParserInterface
{

	/**
	 * @var String regex for docmeta block
	 */
	private $regex = '/^(---(?s)(.*?)---)/i';

	/**
	 * Returns HTML from Markdown, but with all meta
	 * information stripped out.
	 * @param String $text Markdown text
	 * @return String HTML
	 */
	public function text($text)
	{
		$markdown = preg_replace($this->regex, '', $text);
		return parent::text($markdown);
	}

	/**
	 * Returns an array of meta tags from the document
	 * @param String $text Markdown text
	 * @return array
	 */
	public function meta($text) {
		preg_match($this->regex, $text, $matches);
		if(isset($matches[2])) {
			return Yaml::parse(trim($matches[2]));
		}
		return array();
	}

}
