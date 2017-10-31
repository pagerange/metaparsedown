<?php

use Pagerange\Markdown\Parsers\FrontmatterParser;

class FrontmatterParserTest extends PHPUnit\Framework\TestCase
{

	// MetaParsedown instance
	private $mp;

	public function setup()
	{
		$this->mp = new FrontmatterParser;
	}

	public function testCanExtractFrontmatterDataArray()
	{
		$file = file_get_contents(FIXTURES . '/good_frontmatter.md');
		$meta = $this->mp->meta($file);
		$this->assertCount(3, $meta);
	}

	public function testFrontmatterDataContainsKey()
	{
		$file = file_get_contents(FIXTURES . '/good_frontmatter.md');
		$meta = $this->mp->meta($file);
		$this->assertArrayHasKey('title', $meta);
	}

	public function testMetaReturnsEmptyArrayOnFileWithNoFrontmatter()
	{
		$file = file_get_contents(FIXTURES . '/no_meta.md');
		$meta = $this->mp->meta($file);
		$this->assertEmpty($meta);
	}

	public function testMetaDataEmptyOnBrokenFrontmatterTag()
	{
		$file = file_get_contents(FIXTURES . '/broken_frontmatter.md');
		$meta = $this->mp->meta($file);
		$this->assertEmpty($meta);
	}

	/**
	 * @expectedException Symfony\Component\Yaml\Exception\ParseException
	 */
	public function testMetaThrowsParseExceptionOnBadFrontmatterFormat()
	{
		$file = file_get_contents(FIXTURES . '/bad_frontmatter.md');
		$meta = $this->mp->meta($file);
	}

	public function testTextReturnsHtmlSringWithNoLeadingMetadata()
	{
		$file = file_get_contents(FIXTURES . '/good_frontmatter.md');
		$html = $this->mp->text($file);
		$regex = "/^(\<h1\>This is markdown\<\/h1\>)/";
		preg_match($regex, $html, $matches);
		$this->assertEquals('<h1>This is markdown</h1>', $matches[1]);
	}

}