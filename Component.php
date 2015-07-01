<?php
/**
 * @author WeArDe <wearde.studio@gmail.com>
 * @link http://wearde.pp.ua
 */

namespace amass\langprettyurl;


use \lajax\translatemanager\models\Language;
use yii\base\UnknownClassException;

/**
 * Component
 * helper to form an array of languages, working together with yii2-translate-manager https://github.com/lajax/yii2-translate-манагер
 * You can use a class dear
 * 'component' => [
 *  .....
 *     'urlManager' => [
 *        'class' => 'amass\langprettyurl\UrlManager',
 *        'allowClass' => 'amass\langprettyurl\Component',
 *     ],
 *  .....
 * ]
 */

class Component extends \yii\base\Component{

    /** $var $languages array*/
    public $languages;

    /**
     * @inheritdoc
     */
    public function init(){

        if(is_null($this->languages ))
            $this->languages = $this->_loadLanguages();
    }

    /**
     * @throw yii\base\UnknownClassException
     * @return mixed
     */
    private function _loadLanguages(){
        $array = [];
        UrlManager::checkDependency(
            '\lajax\translatemanager\models\Language',
            'lajax/yii2-translate-manager',
            ""
        );

        $model = Language::getLanguages(true, true);
        foreach($model as $language){
            $array[$language['language']] = $language['language_id'];
        }
        return $array;
    }
}