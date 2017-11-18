<?php

use Pagerange\Markdown\MetaParsedown;

define('FIXTURES', __DIR__ . '/fixtures');

class TestMetaParsedown extends PHPUnit\Framework\TestCase
{

	// MetaParsedown instances
	private $mp; // markdown parser

	public function setup()
	{
		$this->mp = new MetaParsedown('yaml');
	}


	public function testCanExtractYamlDataArray()
	{
		$text = file_get_contents(FIXTURES . '/good_frontmatter.md');
		$meta = $this->mp->meta($text);
		$this->assertTrue(is_array($meta));
	}

	public function testYamlTextReturnsHtmlString()
	{
		$text = file_get_contents(FIXTURES . '/good_frontmatter.md');
		$html = $this->mp->text($text);
		$regex = "/(\<h1\>This is markdown\<\/h1\>)/";
		preg_match($regex, $html, $matches);
		$this->assertEquals('<h1>This is markdown</h1>', $matches[1]);
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
	 * @expectedException Pagerange\Markdown\ParserNotFoundException
	 */
	public function testThrowsParserNotFoundExceptionOnUnknownParserType()
	{
		new MetaParsedown('asdfasf');
	}

}