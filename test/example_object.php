<?php

$data = [
    'file_path' => 'languages/{LANGUAGE}.ini',
    'cache_path' => 'cache/',
    'fallback_language' => 'en',
    'return_object' => TRUE,
];
$configVo = new \Biniweb\I18n\Vo\I18nConfigVo($data);

$i18n = new \Biniweb\I18n\I18n($configVo);
$i18n->init();

?>

<p>A greeting: <?php echo L::greeting; ?></p>
<p>Something other: <?php echo L::category_somethingother; ?></p>