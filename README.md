# PHP i18n
Simple PHP i18n

Some of its features:

* Translations in ini-files
* Return array of translation (suitable also for Mustache engine template)

## Setup
To use the i18n class, look at the test/example.php or test/example_mustache.php and test/example_mustache.html.
You will find there a simple tutorial for this class in the file. Otherwise follow these easy five steps:

### 1. Create language files
To use this class, you have to use ini files for the translated strings. This could look like this:

`en.ini` (English)

```ini
greeting = "Hello World!"

[category]
somethingother = "Something other..."
```

`de.ini` (German)

```ini
greeting = "Hallo Welt!"

[category]
somethingother = "Etwas anderes..."
```

### 2. Initialize the class

`example.php`

```php
$data = [
    'file_path' => 'languages/{LANGUAGE}.ini',
];
$configVo = new \Biniweb\I18n\Vo\I18nConfigVo($data);

$l = \Biniweb\I18n\I18n::getInstance()->init($configVo);
```

### 3. Use the localizations

`example.php`

```php
<p>A greeting: <?php echo $l['greeting']; ?> </p>
<p>Something other: <?php echo $l['category_somethingother']; ?> </p>
```

## Mustache

### 2. Initialize the class with Mustache

`example_mustache.php`

```php
$data = [
    'file_path' => 'languages/{LANGUAGE}.ini',
];
$configVo = new \Biniweb\I18n\Vo\I18nConfigVo($data);

$l = \Biniweb\I18n\I18n::getInstance()->init($configVo);

$content = join('', file('example_mustache.html'));

$engine = new Mustache_Engine();

echo $engine->render($content, [
    'l' => $l,
]);
```

### 3. html template

`example_mustache.html`

```html
<p>A greeting: {{#l}} {{greeting}} {{/l}}</p>
<p>Something other: {{#l}} {{category_somethingother}} {{/l}}</p>
```