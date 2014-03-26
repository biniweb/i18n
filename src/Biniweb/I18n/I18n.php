<?php

namespace Biniweb\I18n;

use Biniweb\I18n\Constants\ConfigConstant;
use Biniweb\I18n\Vo\ConfigVo;

class I18n
{
    /** @var \Biniweb\I18n\Vo\ConfigVo */
    protected $_configVo;

    #############################################

    /**
     * @param ConfigVo $vo
     */
    public function __construct(ConfigVo $vo)
    {
        $this->_configVo = $vo;
    }

    #############################################

    /**
     * @return array|bool
     */
    public function init()
    {
        $userLanguages = $this->_checkUserLanguages();

        $appliedLanguage = NULL;
        $languageFilePath = NULL;
        foreach ($userLanguages as $languageCode) {
            $filePath = str_replace('{LANGUAGE}', $languageCode, $this->_configVo->getFilePath());
            if (file_exists($filePath)) {
                $languageFilePath = $filePath;
                $appliedLanguage = $languageCode;
                break;
            }
        }

        if (isset($appliedLanguage) && isset($languageFilePath)) {

            $cacheFilePath = $this->_configVo->getCachePath() . '/php_i18n_' . md5_file(__FILE__) . '_' . $appliedLanguage . '.cache.php';

            if (!file_exists($cacheFilePath) || filemtime($cacheFilePath) < filemtime($languageFilePath)) {
                $config = parse_ini_file($languageFilePath, TRUE);

                $compiled = "<?php class " . ConfigConstant::PREFIX . " {\n";
                $compiled .= $this->_compile($config);
                $compiled .= '}';

                file_put_contents($cacheFilePath, $compiled);
                chmod($cacheFilePath, 0777);
            }

            require_once $cacheFilePath;

            $reflection = new \ReflectionClass(ConfigConstant::PREFIX);

            return $reflection->getConstants();
        }

        return FALSE;

    }

    #############################################

    /**
     * @return array
     */
    protected function _checkUserLanguages()
    {
        $userLanguages = [];

        if ($this->_configVo->hasForcedLanguage()) {
            $userLanguages[] = $this->_configVo->getForcedLanguage();
        }

        $userLanguages[] = $this->_configVo->getFallbackLanguage();

        $userLanguages = array_unique($userLanguages);

        foreach ($userLanguages as $key => $value) {
            $userLanguages[$key] = preg_replace('/[^a-zA-Z0-9]/', '', $value);
        }

        return $userLanguages;
    }


    /**
     * @param $config
     * @return string
     */
    protected function _compile($config)
    {
        $code = '';
        foreach ($config as $key => $value) {
            if (is_array($value)) {
                $code .= $this->_compile($value, $key . ConfigConstant::SECTION_SEPARETOR);
            } else {
                $code .= 'const ' . $key . ' = \'' . str_replace('\'', '\\\'', $value) . "';\n";
            }
        }

        return $code;
    }

}
