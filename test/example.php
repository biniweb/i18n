<?php
$data = [
    'file_path' => 'languages/{LANGUAGE}.ini',
    'cache_path' => 'cache/',
    'fallback_language' => 'en',
];
$configVo = new \Biniweb\I18n\Vo\ConfigVo($data);
$i18n = new \Biniweb\I18n\I18n($configVo);
$i18n->init();
?>

<p>A greeting: <?php echo L::greeting; ?></p>
<p>Something other: <?php echo L::category_somethingother; ?></p>