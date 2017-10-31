<?php

use Pagerange\Markdown\Parsers\DocmetaParser;

class DocmetaParserTest extends PHPUnit\Framework\TestCase
{

	// MetaParsedown instance
	private $mp;

	public function setup()
	{
		$this->mp = new DocmetaParser;
	}

	public function testCanExtractDocmetaDataArray()
	{
		$file = file_get_contents(FIXTURES . '/good_docmeta.md');
		$meta = $this->mp->meta($file);
		$this->assertCount(3, $meta);
	}

	public function testDocmetaDataContainsKey()
	{
		$file = file_get_contents(FIXTURES . '/good_docmeta.md');
		$meta = $this->mp->meta($file);
		$this->assertArrayHasKey('title', $meta);
	}

	public function testMetaReturnsEmptyArrayOnFileWithNoDocmeta()
	{
		$file = file_get_contents(FIXTURES . '/no_meta.md');
		$meta = $this->mp->meta($file);
		$this->assertEmpty($meta);
	}

	public function testMetaDataEmptyOnBrokenDocmetaTag()
	{
		$file = file_get_contents(FIXTURES . '/broken_docmeta.md');
		$meta = $this->mp->meta($file);
		$this->assertEmpty($meta);
	}

	public function testMetaReturnsCorrectNumAttributesOnBadDocmetaFormat()
	{
		$file = file_get_contents(FIXTURES . '/bad_docmeta.md');
		$meta = $this->mp->meta($file);
		$this->assertCount(3, $meta);
	}

	public function testTextReturnsHtmlSringWithNoLeadingMetadata()
	{
		$file = file_get_contents(FIXTURES . '/good_docmeta.md');
		$html = $this->mp->text($file);
		$regex = "/^(\<h1\>This is markdown\<\/h1\>)/";
		preg_match($regex, $html, $matches);
		$this->assertEquals('<h1>This is markdown</h1>', $matches[1]);
	}
	
}