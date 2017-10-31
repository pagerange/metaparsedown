<?php

use Pagerange\Markdown\MetaParsedown;

class TestMetaParsedown extends PHPUnit\Framework\TestCase
{

	// MetaParsedown instances
	private $dm;
	private $fm;

	public function setup()
	{
		$this->dm = new MetaParsedown('docmeta');
		$this->fm = new MetaParsedown('frontmatter');
	}

	public function testCanExtractDocmetaDataArray()
	{
		$file = $this->getGoodDocmeta();
		$meta = $this->dm->meta($file);
		$this->assertTrue(is_array($meta));
	}

	public function testCanExtractFrontmatterDataArray()
	{
		$file = $this->getGoodFrontmatter();
		$meta = $this->fm->meta($file);
		$this->assertTrue(is_array($meta));
	}

	public function testDocmetaTextReturnsHtmlString()
	{
		$file = $this->getGoodDocmeta();
		$html = $this->dm->text($file);
		$regex = "/(\<h1\>This is markdown\<\/h1\>)/";
		preg_match($regex, $html, $matches);
		$this->assertEquals('<h1>This is markdown</h1>', $matches[1]);
	}

	public function testFrontmatterTextReturnsHtmlString()
	{
		$file = $this->getGoodFrontmatter();
		$html = $this->fm->text($file);
		$regex = "/(\<h1\>This is markdown\<\/h1\>)/";
		preg_match($regex, $html, $matches);
		$this->assertEquals('<h1>This is markdown</h1>', $matches[1]);
	}

	/**
	 * @expectedException Pagerange\Markdown\ParserNotFoundException
	 */
	public function testThrowsParserNotFoundExceptionOnUnknownParserType()
	{
		new MetaParsedown('asdfasf');
	}

	public function getGoodDocmeta()
	{
		return "<!--docmeta
title     =   This is markdown
author    =   Steve George
created   =   2017-10-28
updated   = 2017-10-28
category  =  samples
-->
# This is markdown

Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.

* Duis aute irure dolor
* Duis aute irure dolor
* Duis aute irure dolor
* Duis aute irure dolor
* Duis aute irure dolor

		";
	}

	public function getGoodFrontmatter()
	{
		return "---
title: This is markdown
author: Steve George
created: 2017-10-28
---
# This is markdown

This is a paragraph.

* Bullet
* Bullet
* Bullet

This is another paragraph

		";
	}


}