<?php

namespace Biniweb\I18n;

use Biniweb\I18n\Constants\I18nConfigConstant;
use Biniweb\I18n\Vo\I18nConfigVo;

class I18n
{
    /** @var \Biniweb\I18n\Vo\I18nConfigVo */
    protected $_configVo;

    #############################################

    /**
     * @param I18nConfigVo $vo
     */
    public function __construct(I18nConfigVo $vo)
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
                $compiled = "<?php class " . I18nConfigConstant::PREFIX . " {\n";
                $compiled .= $this->_compile($config);
                $compiled .= '}';
                file_put_contents($cacheFilePath, $compiled);
                chmod($cacheFilePath, 0777);
            }

            require_once $cacheFilePath;

            if (!$this->_configVo->getReturnObject()) {

                return (new \ReflectionClass(I18nConfigConstant::PREFIX))->getConstants();
            }
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

    #############################################

    /**
     * @param $config
     * @return string
     */
    protected function _compile($config)
    {
        $code = '';
        foreach ($config as $key => $value) {
            if (is_array($value)) {
                $code .= $this->_compile($value, $key . I18nConfigConstant::SECTION_SEPARETOR);
            } else {
                $code .= 'const ' . $key . ' = \'' . str_replace('\'', '\\\'', $value) . "';\n";
            }
        }

        return $code;
    }

}
