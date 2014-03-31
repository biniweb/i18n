<?php

namespace Biniweb\I18n\Vo;

use Biniweb\I18n\Constants\I18nConfigConstant;

class I18nConfigVo
{
    /** @var  string */
    protected $_filePath;

    /** @var  string */
    protected $_fallbackLanguage;

    /** @var  string */
    protected $_forcedLanguage;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->_filePath = $data['file_path'];
        $this->_fallbackLanguage = isset($data['fallback_language']) ? $data['fallback_language'] : I18nConfigConstant::DEFAULT_FALLBACK;
        $this->_forcedLanguage = isset($data['forced_language']) ? $data['forced_language'] : I18nConfigConstant::DEFAULT_FALLBACK;
    }

    /**
     * @return string
     */
    public function getFilePath()
    {
        return $this->_filePath;
    }

    /**
     * @return string
     */
    public function getFallbackLanguage()
    {
        return $this->_fallbackLanguage;
    }

    /**
     * @return string
     */
    public function getForcedLanguage()
    {
        return $this->_forcedLanguage;
    }

}