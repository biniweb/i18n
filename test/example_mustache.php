<?php

$data = [
    'file_path' => 'languages/{LANGUAGE}.ini',
    'cache_path' => 'cache/',
    'fallback_language' => 'en',
];
$configVo = new \Biniweb\I18n\Vo\I18nConfigVo($data);

$i18n = new \Biniweb\I18n\I18n($configVo);
$l = $i18n->init();

$content = join('', file('example_mustache.html'));

$engine = new Mustache_Engine();
echo $engine->render($content, [
    'l' => $l,
]);