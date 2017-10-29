<?php

use Pagerange\Markdown\MetaParsedown;

class TestMetaParsedown extends PHPUnit\Framework\TestCase
{

	// MetaParsedown instance
	private $mp;

	public function setup()
	{
		$this->mp = new MetaParsedown;
	}

	public function testMetaParseDownCanBeInstantiated()
	{
		$this->assertInstanceOf('\Pagerange\Markdown\MetaParsedown', $this->mp);
	}

	public function testMetaParseDownInstanceOfParsedown()
	{
		$this->assertInstanceOf('\Parsedown', $this->mp);
	}

	public function testCanExtractMetaDataArray()
	{
		$file = $this->getGoodMeta();
		$meta = $this->mp->meta($file);
		$this->assertCount(3, $meta);
	}

	public function testMetaDataContainsKey()
	{
		$file = $this->getGoodMeta();
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
		$file = $this->getBrokenMeta();
		$meta = $this->mp->meta($file);
		$this->assertEmpty($meta);
	}

	public function testMetaReturnsCorrectNumAttributesOnBadIniFormat()
	{
		$file = $this->getBadIni();
		$meta = $this->mp->meta($file);
		$this->assertCount(3, $meta);
	}

	public function testNoMetaReturnsHtmlWithoutMetaData()
	{
		$file = $this->getGoodMeta();
		$regex = '/(<\!--docmeta(?s)(.*?)-->)/i';
		$html = $this->mp->noMeta($file);
		preg_match($regex, $html, $matches);
		$this->assertEmpty($matches);
	}

	public function testTextReturnsHtmlWithMetaData()
	{
		$file = $this->getGoodMeta();
		$regex = '/(<\!--docmeta(?s)(.*?)-->)/i';
		$html = $this->mp->text($file);
		preg_match($regex, $html, $matches);
		$this->assertCount(3, $matches);
	}

	public function getGoodMeta()
	{
		return "<!--docmeta
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

	public function getBrokenMeta()
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

	public function getBadIni()
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
