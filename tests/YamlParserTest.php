<?php

use Pagerange\Markdown\Parsers\YamlParser;

class YamlParserTest extends PHPUnit\Framework\TestCase
{

	// MetaParsedown instance
	private $mp;

	public function setup()
	{
		$this->mp = new YamlParser;
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

	public function testYamlStripMetaReturnsBareMarkdown()
	{
		$text = file_get_contents(FIXTURES . '/good_frontmatter.md');
		$markdown = $this->mp->stripMeta($text);
		$pos = strpos('# This is markdown', $markdown);
		$this->assertEquals($pos, 0);

	}

	public function testYamlStripMetaWhenNoMetaExistsReturnsBareMarkdown()
	{
		$text = file_get_contents(FIXTURES . '/no_meta.md');
		$markdown = $this->mp->stripMeta($text);
		$pos = strpos('# This is markdown', $markdown);
		$this->assertEquals($pos, 0);

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