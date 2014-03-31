<?php

$data = [
    'file_path' => 'languages/{LANGUAGE}.ini',
];
$configVo = new \Biniweb\I18n\Vo\I18nConfigVo($data);

$l = \Biniweb\I18n\I18n::getInstance()->init($configVo);

?>

<p>A greeting: <?php echo $l['greeting']; ?></p>
<p>Something other: <?php echo $l['category_somethingother']; ?></p>