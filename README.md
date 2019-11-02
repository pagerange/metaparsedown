## MetaParsedown

MetaParsedown extends **erusev/parsedown** and **eruseve/parsedown-extra**, very nice markdown parsers, by adding the ability to have metadata in markdown or markdown-extra files in the form of valid yaml.  MetaParsedown uses the Symfony Yaml component to parse and extract the metadata.  I created this because we were creating a markdown document management system and needed a way to add metadata to each file.  The other option was a separate metadata file for each markdown file, which is fine, but seemed cumborsome for those creating the documents.  This way seemed easier and is pretty simple to use.

MetaParsedown retains all the functionality of **erusev/parsedown**, but adds two methods:

* **meta($markdown)** -- returns an array of the key/value metadata tags in the markdown

* **stripMeta($markdown)** returns bare markdown with yaml frontmatter stripped out

Parsedown's original **text($markdown)** method continues to return HTML, without the metadata tags

MetaParsedown is also available as a [Wordpress plugin](https://github.com/pagerange/metaparsedown-wordpress).

### Installation

Please use [the composer package](https://packagist.org/packages/pagerange/metaparsedown) to include Metaparsedown in your project.

```bash

composer require pagerange/metaparsedown

```

### Adding meta data

Add metadata as valid yaml key/value pairs, delimited by three dashes at the start and end.  This yaml block must appear at the start of the document.  

```markdown
    
---
title: 'My Great Document'
author: 'Yours Truly'
description: 'A short document with very little to say'
status: 'public'
created_at: '2017-11-18 12:01:00'
---
# My Great Document

This is the rest of the markdown document

* bullet list item
* bullet list item

```

### Usage

``` php

use Pagerange\Markdown\MetaParsedown;

$mp = new MetaParsedown(); 

echo $mp->text($markdown); // prints HTML, without meta data

$meta = $mp->meta($markdown); // returns an array of key/value pairs

$bare_markdown = $mp->stripMeta($markdown); // returns markdown without yaml block
  
```

See the [`erusev/parsedown` git page](https://github.com/erusev/parsedown) or the [`erusev/parsedown-extra` git page](https://github.com/erusev/parsedown-extra)for more information and detailed documentation on how to use it and how it works.

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





