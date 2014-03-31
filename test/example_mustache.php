<?php

$data = [
    'file_path' => 'languages/{LANGUAGE}.ini',
    'fallback_language' => 'en',
];
$configVo = new \Biniweb\I18n\Vo\I18nConfigVo($data);

$l = \Biniweb\I18n\I18n::getInstance()->init($configVo);

$content = join('', file('example_mustache.html'));

$engine = new Mustache_Engine();
echo $engine->render($content, [
    'l' => $l,
]);