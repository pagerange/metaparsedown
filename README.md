## MetaParsedown

MetaParsedown extends **erusev/parsedown**, a very nice markdown parser, by adding the ability to have metadata in markdown files.  I created this because we were creating a markdown document management system and needed a way to add metadata to each file.  The other option was a separate metadata file for each markdown file, which is fine, but seemed cumborsome for those creating the documents.  This way seemed easier and is pretty easy to use.

MetaParsedown retains all the functionality of **erusev\parsedown**, but adds two methods:

* **meta($markdown)** -- returns an array of the key/value pair metadata tags in the markdown
* **noMeta($markdown)** -- returns the parsed mardown with the metadata removed for HTML output

If you don't care if the metadata is removed, just use Parsedown's original method:

* **text($text)** -- returns the parsed markdown (including the metadata as part of the HTML)


### Installation

Include `erusev\parsedown` original class `Parsedown.php`, and `MetaParsedown` or install [the composer package](https://packagist.org/packages/pagerange/metaparsedown).

### Adding meta data

Add meta data in ini format anywhere in the document.  The ini key/value pairs must be inside a `docmeta` block (a simple HTML comment block).  This does not break markdown... it's just an HTML comment.  The ini key/value pairs must follow standard ini format.  The `docmeta` comment block can be anywhere in the document... but just once.

```html
  
<!--docmeta

title = My Great Document
author = Yours Truly
date = 2017-10-29

-->

# Markdown title

This is the rest of the markdown document

* bullet list item
* bullet list item

```

### Usage

``` php

$mp = new MetaParsedown();

echo $mp->text($markdown); // prints HTML, including docmeta block

echo $mp->noMeta($markdown); // prints HTML, without docmeta block

$meta $mp->meta($markdown); // returns an array of docmeta key/value pairs
  
```

Please see the `erusev\parsedown` git page for more information and detailed documentation on how to use it and how it works.

### License





