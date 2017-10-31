<?php

namespace Pagerange\Markdown;

interface ParserInterface
{
	
	/**
	 * Wrapper for erusev/parsedown method, strips
	 * meta data before calling parent
	 * @param String $text Markdown
	 * @return String HTML
	 */
	public function text($text);

	/**
	 * Extracts meta data and returns it as array.
	 * @param String $text Markdown with 
	 * @return Array
	 */
	public function meta($text);

}