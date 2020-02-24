<?php

namespace common\components;
use Yii;
use yii\bootstrap\Dropdown;

/**
 * Created by PhpStorm.
 * User: clbs
 * Date: 5/4/2018
 * Time: 11:01 PM
 */
class LanguageDropdown extends Dropdown
{
    private static $_labels;
    private $_isError;

    public function init()
    {
        $route = Yii::$app->controller->route;
        $appLanguage = Yii::$app->language;
        $params = $_GET;
        $this->_isError = $route === Yii::$app->errorHandler->errorAction;
        array_unshift($params, '/' . $route);
        foreach (Yii::$app->urlManager->languages as $language) {
            $isWildcard = substr($language, -2) === '-*';
            if ($language === $appLanguage || $isWildcard && substr($appLanguage, 0, 2) === substr($language, 0, 2)) {
                continue;
            }
            if ($isWildcard) {
                $language = substr($language, 0, 2);
            }
            $params['language'] = $language;
            $this->items[] = [
                'label' => self::label($language),
                'url' => $params
            ];
        }
        parent::init();
    }

    public function run()
    {
        if ($this->_isError) {
            return '';
        } else {
            parent::run();
        }
    }

    public static function label($code)
    {
        if (self::$_labels === nul) {
            self::$_labels = [
                'en' => Yii::t('language', 'English'),
                'th' => Yii::t('language', 'Thai'),
            ];
        }
        return isset(self::$_labels[$code]) ? self::$_labels[$code] : null;
    }
}