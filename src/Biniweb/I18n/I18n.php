<?php

namespace Biniweb\I18n;

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

    public function init()
    {
        $this->_configVo->setInitialized(TRUE);

        $userLanguages = $this->checkUserLanguages();
        $this->_configVo->setUserLanguages($userLanguages);

        $this->_configVo->setAppliedLanguage(NULL);
        foreach ($this->_configVo->getUserLanguages() as $languageCode) {
            $languageFilePath = str_replace('{LANGUAGE}', $languageCode, $this->_configVo->getFilePath());
            $this->_configVo->setLanguageFilePath($languageFilePath);
            if (file_exists($languageFilePath)) {
                $this->_configVo->setAppliedLanguage($languageCode);
                break;
            }
        }

        $cacheFilePath = $this->_configVo->getCachePath() . '/php_i18n_' . md5_file(__FILE__) . '_' . $this->_configVo->getAppliedLanguage() . '.cache.php';
        $this->_configVo->setCacheFilePath($cacheFilePath);

        if (
            !file_exists($this->_configVo->getCacheFilePath())
            || filemtime($this->_configVo->getCacheFilePath()) < filemtime($this->_configVo->getLanguageFilePath())
        ) {
            $config = parse_ini_file($this->_configVo->getLanguageFilePath(), TRUE);

            $compiled = "<?php class " . $this->_configVo->getPrefix() . " {\n";
            $compiled .= $this->_compile($config);
            $compiled .= '}';

            file_put_contents($this->_configVo->getCacheFilePath(), $compiled);
            chmod($this->_configVo->getCacheFilePath(), 0777);

        }

        require_once $this->_configVo->getCacheFilePath();
    }

    #############################################

    /**
     * @return array
     */
    public function checkUserLanguages()
    {
        $userLanguages = [];

        if ($this->_configVo->hasForcedLanguage()) {
            $userLanguages[] = $this->_configVo->getForcedLanguage();
        }

        if (isset($_GET['current-language']) && is_string($_GET['current-language'])) {
            $userLanguages[] = $_GET['current-language'];
        }

        if (isset($_SESSION['current-language']) && is_string($_SESSION['current-language'])) {
            $userLanguages[] = $_SESSION['current-language'];
        }

        if (isset($_COOKIE['current-language']) && is_string($_COOKIE['current-language'])) {
            $userLanguages[] = $_COOKIE['current-language'];
        }

        if (isset($_SERVER['GEOIP_COUNTRY_CODE_BY_NAME'])) {
            $userLanguages[] = strtolower($_SERVER['GEOIP_COUNTRY_CODE_BY_NAME']);
        }

        if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            foreach (explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']) as $part) {
                $userLanguages[] = strtolower(substr($part, 0, 2));
            }
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
                $code .= $this->_compile($value, $key . $this->_configVo->getSectionSeperator());
            } else {
                $code .= 'const ' . $this->_configVo->getPrefix() . $key . ' = \'' . str_replace('\'', '\\\'', $value) . "';\n";
            }
        }

        return $code;
    }

}
