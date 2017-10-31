## MetaParsedown

MetaParsedown extends **erusev/parsedown**, a very nice markdown parser, by adding the ability to have metadata in markdown files.  I created this because we were creating a markdown document management system and needed a way to add metadata to each file.  The other option was a separate metadata file for each markdown file, which is fine, but seemed cumborsome for those creating the documents.  This way seemed easier and is pretty simple to use.

MetaParsedown retains all the functionality of **erusev/parsedown**, but adds one method:

* **meta($markdown)** -- returns an array of the key/value metadata tags in the markdown

Parsedown's original **text($markdown)** method continues to return HTML, without the metadata tags

### Installation

Include `erusev/parsedown` original class `Parsedown.php`, and `MetaParsedown` or install [the composer package](https://packagist.org/packages/pagerange/metaparsedown).

### Adding meta data

Add metadata in one of two ways.  

One, in what I'm calling a `docmeta` block (a simple HTML comment), anywhere in the file (once), with the meta tags in ini format.  I prefer this myself, because the markdown is valid regardless of the markdown parser used.

```html
   
<!--docmeta
title = My Great Document
author = Yours Truly
date = 2017-10-29
-->
# My Great Document

This is the rest of the markdown document

* bullet list item
* bullet list item

```

Two, in standard `frontmatter` format, in valid YAML, with `---` before and after.  Basically the same as Jekyl.  This is parsed by the Symfony Yaml component.  The frontmatter must appear at the head of the document.  

```yaml
    
---
title: My Great Document
author: Yours Truly
date: 2017-10-29
---
# My Great Document

This is the rest of the markdown document

* bullet list item
* bullet list item

```

### Usage

``` php

$mp = new MetaParsedown(); // defaults to docmeta format

$mp = new MetaParsedown('frontmatter'); // yaml frontmatter

$mp = new MetaParsedown('docmeta'); // docmeta format



echo $mp->text($markdown); // prints HTML, without meta data

$meta = $mp->meta($markdown); // returns an array of docmeta key/value pairs
  
```

Please see the [`erusev/parsedown` git page](https://github.com/erusev/parsedown) for more information and detailed documentation on how to use it and how it works.

### License

MIT License

Copyright (c) 2017 Steve George

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.





