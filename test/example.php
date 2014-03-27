<?php
use \Biniweb\I18n\Vo\ConfigVo;
use \Biniweb\I18n\I18n;
$data = [
    'file_path' => 'languages/{LANGUAGE}.ini',
    'cache_path' => 'cache/',
    'fallback_language' => 'en',
];
$configVo = new ConfigVo($data);
$i18n = new I18n($configVo);
$l = $i18n->init();
?>

<p>A greeting: <?php echo $l['greeting']; ?></p>
<p>Something other: <?php echo $l['category_somethingother']; ?></p>