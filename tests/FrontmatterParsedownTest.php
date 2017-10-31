<?php

use Pagerange\Markdown\FrontmatterParsedown;

class FrontmatterParsedownTest extends PHPUnit\Framework\TestCase
{

	// MetaParsedown instance
	private $mp;

	public function setup()
	{
		$this->mp = new FrontmatterParsedown;
	}

	public function testCanExtractFrontmatterDataArray()
	{
		$file = $this->getGoodFrontmatter();
		$meta = $this->mp->meta($file);
		$this->assertCount(3, $meta);
	}

	public function testFrontmatterDataContainsKey()
	{
		$file = $this->getGoodFrontmatter();
		$meta = $this->mp->meta($file);
		$this->assertArrayHasKey('title', $meta);
	}

	public function testMetaReturnsEmptyArrayOnFileWithNoFrontmatter()
	{
		$file = $this->getNoMeta();
		$meta = $this->mp->meta($file);
		$this->assertEmpty($meta);
	}

	public function testMetaDataEmptyOnBrokenFrontmatterTag()
	{
		$file = $this->getBrokenFrontmatter();
		$meta = $this->mp->meta($file);
		$this->assertEmpty($meta);
	}

	/**
	 * @expectedException Symfony\Component\Yaml\Exception\ParseException
	 */
	public function testMetaThrowsParseExceptionOnBadFrontmatterFormat()
	{
		$file = $this->getBadFrontmatter();
		$meta = $this->mp->meta($file);
	}

	public function testTextReturnsHtmlSringWithNoLeadingMetadata()
	{
		$file = $this->getGoodFrontmatter();
		$html = $this->mp->text($file);
		$regex = "/^(\<h1\>This is markdown\<\/h1\>)/";
		preg_match($regex, $html, $matches);
		$this->assertEquals('<h1>This is markdown</h1>', $matches[1]);
	}

	
	public function getNoMeta()
	{
		return "# This is markdown

		This is a paragraph.

		* Bullet
		* Bullet
		* Bullet

		This is another paragraph

		";
	}

	public function getGoodFrontmatter()
	{
		return "---
title 	  : This is markdown
author    : Steve George
created   : 2017-10-28
---
# This is markdown

This is a paragraph.

* Bullet
* Bullet
* Bullet

This is another paragraph

		";
	}

	public function getBrokenFrontmatter()
	{
		return "--
title 	  :	Configuring Wordpress
author    :	Steve George
created   : 2017-10-28
---
# This is markdown

This is a paragraph.

* Bullet
* Bullet
* Bullet

This is another paragraph

		";

	}

	public function getBadFrontmatter()
	{
		return "---
title 	  :	Configuring: Wordpress
author    :	Steve George
created   : 2017-10-28
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