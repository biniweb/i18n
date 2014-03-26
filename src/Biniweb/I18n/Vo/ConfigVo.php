<?php

namespace Biniweb\I18n\Vo;

class ConfigVo
{
    /** @var  string */
    protected $_filePath;

    /** @var  string */
    protected $_cachePath;

    /** @var  string */
    protected $_fallbackLanguage;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->_filePath = $data['file_path'];
        $this->_cachePath = $data['cache_path'];
        $this->_fallbackLanguage = $data['fallback_language'];
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
}