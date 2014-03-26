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

    /** @var  string */
    protected $_prefix;

    /** @var  string */
    protected $_sectionSeperator;

    /** @var  bool */
    protected $_Initialized;

    /** @var  string */
    protected $_forcedLanguage;

    /** @var  array */
    protected $_userLanguages;

    /** @var  string */
    protected $_appliedLanguage;

    /** @var  string */
    protected $_languageFilePath;

    /** @var  string */
    protected $_cacheFilePath;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->_filePath = $data['file_path'];
        $this->_cachePath = $data['cache_path'];
        $this->_fallbackLanguage = $data['fallback_language'];
        $this->_prefix = isset($data['prefix']) ? $data['prefix'] : 'L';
        $this->_Initialized = FALSE;
        $this->_appliedLanguage = NULL;
        $this->_sectionSeperator = isset($data['section_separetor']) ? $data['section_separetor'] : '_';
        $this->_userLanguages = isset($data['user_languages']) ? $data['user_languages'] : [];
        $this->_forcedLanguage = isset($data['forced_language']) ? $data['forced_language'] : NULL;
    }

    /**
     * @return string
     */
    public function getPrefix()
    {
        return $this->_prefix;
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
     * @param $appliedLanguage
     * @return $this
     */
    public function setAppliedLanguage($appliedLanguage)
    {
        $this->_appliedLanguage = $appliedLanguage;
        return $this;
    }

    /**
     * @return string
     */
    public function getAppliedLanguage()
    {
        return $this->_appliedLanguage;
    }

    /**
     * @param $cacheFilePath
     * @return $this
     */
    public function setCacheFilePath($cacheFilePath)
    {
        $this->_cacheFilePath = $cacheFilePath;
        return $this;
    }

    /**
     * @return string
     */
    public function getCacheFilePath()
    {
        return $this->_cacheFilePath;
    }

    /**
     * @param $forcedLanguage
     * @return $this
     */
    public function setForcedLanguage($forcedLanguage)
    {
        $this->_forcedLanguage = $forcedLanguage;
        return $this;
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
        if ($this->_forcedLanguage !== NULL) {
            return TRUE;
        }

        return FALSE;
    }

    /**
     * @param $isInitialized
     * @return $this
     */
    public function setInitialized($isInitialized)
    {
        $this->_Initialized = $isInitialized;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getInitialized()
    {
        return $this->_Initialized;
    }

    /**
     * @param $languageFilePath
     * @return $this
     */
    public function setLanguageFilePath($languageFilePath)
    {
        $this->_languageFilePath = $languageFilePath;
        return $this;
    }

    /**
     * @return string
     */
    public function getLanguageFilePath()
    {
        return $this->_languageFilePath;
    }

    /**
     * @param $sectionSeperator
     * @return $this
     */
    public function setSectionSeperator($sectionSeperator)
    {
        $this->_sectionSeperator = $sectionSeperator;
        return $this;
    }

    /**
     * @return string
     */
    public function getSectionSeperator()
    {
        return $this->_sectionSeperator;
    }

    /**
     * @param $userLanguages
     * @return $this
     */
    public function setUserLanguages($userLanguages)
    {
        $this->_userLanguages = $userLanguages;
        return $this;
    }

    /**
     * @return array
     */
    public function getUserLanguages()
    {
        return $this->_userLanguages;
    }


}