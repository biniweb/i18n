<?php

namespace Biniweb\I18n\Vo;

class I18nConfigVo
{
    /** @var  string */
    protected $_filePath;

    /** @var  string */
    protected $_cachePath;

    /** @var  string */
    protected $_fallbackLanguage;

    /** @var  bool */
    protected $_returnObject;

    /** @var  string */
    protected $_forcedLanguage;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->_filePath = $data['file_path'];
        $this->_cachePath = $data['cache_path'];
        $this->_fallbackLanguage = $data['fallback_language'];
        $this->_returnObject = isset($data['return_object']) ? $data['return_object'] : FALSE;
        $this->_forcedLanguage = isset($data['forced_language']) ? $data['forced_language'] : NULL;
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
    public function getCachePath()
    {
        return $this->_cachePath;
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

    /**
     * @return bool
     */
    public function hasForcedLanguage()
    {
        if (isset($this->_forcedLanguage)) {
            return TRUE;
        }

        return FALSE;
    }

    /**
     * @return boolean
     */
    public function getReturnObject()
    {
        return $this->_returnObject;
    }

}