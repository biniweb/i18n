<?php

namespace Biniweb\I18n;

use Biniweb\I18n\Constants\I18nConfigConstant;
use Biniweb\I18n\Vo\I18nConfigVo;
use Simplon\Helper\SingletonTrait;

class I18n
{
    use SingletonTrait;

    #############################################

    /**
     * @param I18nConfigVo $vo
     * @return array|bool
     */
    public function init(I18nConfigVo $vo)
    {
        $userLanguages = $this->_checkUserLanguages($vo);
        $languageCode = NULL;
        $languageFilePath = NULL;
        $translations = [];

        foreach ($userLanguages as $code) {

            $filePath = str_replace(I18nConfigConstant::TRANSLATE_PARAM, $code, $vo->getFilePath());

            if (file_exists($filePath)) {

                $languageFilePath = $filePath;
                $languageCode = $code;
                break;
            }
        }

        if (isset($languageCode) && isset($languageFilePath)) {

            $translationsData = parse_ini_file($languageFilePath, TRUE);

            $translations = $this->_compile($translationsData);
        }

        if (!empty($translations)) {

            return $translations;
        }

        return FALSE;
    }

    #############################################

    /**
     * @param I18nConfigVo $vo
     * @return array
     */
    protected function _checkUserLanguages(I18nConfigVo $vo)
    {
        $userLanguages[] = $vo->getForcedLanguage();

        $userLanguages[] = $vo->getFallbackLanguage();

        $userLanguages = array_unique($userLanguages);

        foreach ($userLanguages as $key => $value) {

            $userLanguages[$key] = preg_replace(I18nConfigConstant::REGEX_CHECK_LANG, '', $value);
        }

        return $userLanguages;
    }

    #############################################

    /**
     * @param array $translations
     * @param string $section
     * @return array
     */
    protected function _compile(array $translations, $section = '')
    {
        $result = [];

        foreach ($translations as $key => $value) {

            if (is_array($value)) {

                $result = array_merge($result, $this->_compile($value, $key . I18nConfigConstant::SECTION_SEPARETOR));
            } else {

                $result[$section . $key] = $value;
            }
        }

        return $result;
    }

}
