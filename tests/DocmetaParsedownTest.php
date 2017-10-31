<?php

use Pagerange\Markdown\DocmetaParsedown;

class DocmetaParsedownTest extends PHPUnit\Framework\TestCase
{

	// MetaParsedown instance
	private $mp;

	public function setup()
	{
		$this->mp = new DocmetaParsedown;
	}

	public function testCanExtractDocmetaDataArray()
	{
		$file = $this->getGoodDocmeta();
		$meta = $this->mp->meta($file);
		$this->assertCount(3, $meta);
	}

	public function testDocmetaDataContainsKey()
	{
		$file = $this->getGoodDocmeta();
		$meta = $this->mp->meta($file);
		$this->assertArrayHasKey('title', $meta);
	}

	public function testMetaReturnsEmptyArrayOnFileWithNoDocmeta()
	{
		$file = $this->getNoMeta();
		$meta = $this->mp->meta($file);
		$this->assertEmpty($meta);
	}

	public function testMetaDataEmptyOnBrokenDocmetaTag()
	{
		$file = $this->getBrokenDocmeta();
		$meta = $this->mp->meta($file);
		$this->assertEmpty($meta);
	}

	public function testMetaReturnsCorrectNumAttributesOnBadDocmetaFormat()
	{
		$file = $this->getBadDocmeta();
		$meta = $this->mp->meta($file);
		$this->assertCount(3, $meta);
	}

	public function testTextReturnsHtmlSringWithNoLeadingMetadata()
	{
		$file = $this->getGoodDocmeta();
		$html = $this->mp->text($file);
		$regex = "/^(\<h1\>This is markdown\<\/h1\>)/";
		preg_match($regex, $html, $matches);
		$this->assertEquals('<h1>This is markdown</h1>', $matches[1]);
	}

	public function getGoodDocmeta()
	{
		return "
<!--docmeta
title     =   This is markdown
author    =   Steve George
created   =   2017-10-28
-->
# This is markdown

This is a paragraph.

* Bullet
* Bullet
* Bullet

This is another paragraph

		";
	}

	public function getBrokenDocmeta()
	{
		return "<!--doc
		title     =   Configuring Wordpress
		author    =   Steve George
		created   =   2017-10-28
		-->
		# This is markdown

		This is a paragraph.

		* Bullet
		* Bullet
		* Bullet

		This is another paragraph

		";
	}

	public function getBadDocmeta()
	{
		return "<!--docmeta
		title     =   Good
		updated   : Bad
		category  =  good
		tags    = good
		-->
		# This is markdown

		This is a paragraph.

		* Bullet
		* Bullet
		* Bullet

		This is another paragraph

		";
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

	
}