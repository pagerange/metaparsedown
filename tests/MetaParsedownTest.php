<?php

use Pagerange\Markdown\MetaParsedown;

define('FIXTURES', __DIR__ . '/fixtures');

class TestMetaParsedown extends PHPUnit\Framework\TestCase
{

	// MetaParsedown instances
	private $dm; // docmeta parser
	private $fm; // frontmatter parser

	public function setup()
	{
		$this->dm = new MetaParsedown('docmeta');
		$this->fm = new MetaParsedown('frontmatter');
	}

	public function testCanExtractDocmetaDataArray()
	{
		$file = file_get_contents(FIXTURES . '/good_docmeta.md');
		$meta = $this->dm->meta($file);
		$this->assertTrue(is_array($meta));
	}

	public function testCanExtractFrontmatterDataArray()
	{
		$file = file_get_contents(FIXTURES . '/good_frontmatter.md');
		$meta = $this->fm->meta($file);
		$this->assertTrue(is_array($meta));
	}

	public function testDocmetaTextReturnsHtmlString()
	{
		$file = file_get_contents(FIXTURES . '/good_docmeta.md');
		$html = $this->dm->text($file);
		$regex = "/(\<h1\>This is markdown\<\/h1\>)/";
		preg_match($regex, $html, $matches);
		$this->assertEquals('<h1>This is markdown</h1>', $matches[1]);
	}

	public function testFrontmatterTextReturnsHtmlString()
	{
		$file = file_get_contents(FIXTURES . '/good_frontmatter.md');
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

}