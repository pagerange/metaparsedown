<?php

/**
* Extends Erusev\Parsedown with ability to have
* YAML metadata in markdown
* @author Steve George <steve@pagerange.com>
* @created 2017-10-29
* @updated 2017-11-15
* @license MIT
*/

namespace Pagerange\Markdown\Parsers;

use \Symfony\Component\Yaml\Yaml;

class YamlParser extends \ParsedownExtra implements ParserInterface
{

	/**
	 * @var String regex for docmeta block
	 */
	private $regex = '/^(---(?s)(.*?)---)/i';

	/**
	 * Strips frontmatter metadata.  
	 * Passes clean markdown to parent.  
	 * Returns HTML.
	 * @param String $text Markdown text
	 * @return String HTML
	 */
	public function text($text)
	{
		$markdown = $this->stripMeta($text);
		return parent::text($markdown);
	}

	/**
	 * Extracts frontmatter as string
	 * Parses extracted string as YAML
	 * Returns array of metadata
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

	/**
	 * Returns markdown without meta tag block
	 * @param  String $text markdown including meta tag block
	 * @return String Markdown without meta tag block
	 */
	public function stripMeta($text)
	{
		return preg_replace($this->regex, '', $text);
	}

}
