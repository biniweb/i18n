<?php
$data = [
    'file_path' => 'languages/{LANGUAGE}.ini',
    'cache_path' => 'cache/',
    'fallback_language' => 'en',
];
$configVo = new \Biniweb\I18n\Vo\ConfigVo($data);
$i18n = new \Biniweb\I18n\I18n($configVo);
$language = $i18n->init();
?>

<p>A greeting: <?php echo $language['greeting']; ?></p>
<p>Something other: <?php echo $language['category_somethingother']; ?></p>