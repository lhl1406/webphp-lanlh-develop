<?php

namespace App\Libs;

use Symfony\Component\Yaml\Yaml;

class ConfigUtil
{
    const PATH = 'config/Constant/';
    const VALUE_LIST_DIR = 'Values';
    const MESSAGE_DIR = 'Messages';

    /**
     * Get root path
     * @return string
     */
    public static function rootPath()
    {
        return __DIR__ . '/../../';
    }

    /**
     * get config
     * 
     * @param string $folderName
     * @param string $paramKey
     * @return null
     */
    public static function getConfig($folderName, $paramKey)
    {
        global $ConfigFile;
        global $Config;

        $folderPath = self::rootPath() . self::PATH . $folderName;
        $paramKeyArr = explode('.', $paramKey);

        foreach (glob($folderPath . '/*.yml') as $yamlSrc) {
            $paramValue = Yaml::parse(file_get_contents($yamlSrc));
            $ConfigFile[basename($yamlSrc)] = $paramValue;
            
            $found = true;
            foreach ($paramKeyArr as $key) {
                if (!isset($paramValue[$key])) {
                    $found = false;
                    break;
                }

                $paramValue = $paramValue[$key];
            }
            if ($found) {
                $cacheConfig[$paramKey] = $paramValue;
                
                return $paramValue;
            }
        }
        return null;
    }

    /**
     * Get message from message_file, params is optional
     * 
     * @param string $key
     * @param array $paramArray
     * @return mixed|null
     */
    public static function getMessage($key, $paramArray = []) {
        $message = self::getConfig(self::MESSAGE_DIR, $key);
        if ($message && is_string($message)) {
            foreach ($paramArray as $param => $value) {
                $message = str_replace(sprintf('<%d>', $param), $value, $message);
            }
        }

        return $message;
    }
}
