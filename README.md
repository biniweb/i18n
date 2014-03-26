# PHP i18n
Simple PHP i18n

Some of its features:

* Translations in ini-files
* File caching
* Return array of translation (suitable for Mustache engine template)
* Automatic finding out what language to use

## Setup
To use the i18n class, look at the test/example.php. You will find there a simple tutorial for this class in the file. Otherwise follow these easy five steps:

### 1. Create language files
To use this class, you have to use ini files for the translated strings. This could look like this:

`lang_en.ini` (English)

```ini
greeting = "Hello World!"

[category]
somethingother = "Something other..."
```

`lang_de.ini` (German)

```ini
greeting = "Hallo Welt!"

[category]
somethingother = "Etwas anderes..."
```

### 2. Initialize the class

`<?php
`use \Biniweb\I18n\Vo\ConfigVo;
`use \Biniweb\I18n\I18n;
`$data = [
```'file_path' => 'languages/{LANGUAGE}.ini',
```'cache_path' => 'cache/',
```'fallback_language' => 'en',
`];
`$configVo = new ConfigVo($data);
`$i18n = new I18n($configVo);
`$language = $i18n->init();
