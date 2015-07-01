<?php
/**
 * @author WeArDe <wearde.studio@gmail.com>
 * @link http://wearde.pp.ua
 */
namespace amass\langprettyurl;

use Yii;
use yii\base\InvalidConfigException;
use codemix\localeurls\UrlManager as BaseUrlManager;
use amass\langprettyurl\Component;


/**
 * UrlManager
 *
 * This class extends Yii's UrlManager and adds features to detect the language from the URL
 * or from browser settings transparently. It also can persist the language in the user session
 * and optionally in a cookie. It also adds the language parameter to any created URL.
 */
class UrlManager extends BaseUrlManager
{

    /**
     * @var string class will use for yii2-translate-manager https://github.com/lajax/yii2-translate-manager
     */
    public $allowClass;

    /**
     * @inheritdoc
     */
    public function init()
    {
        self::checkDependency(
            'codemix\localeurls\UrlManager',
            'codemix/yii2-localeurls',
            ""
        );

        if (empty($this->languages)) {
            if (empty($this->allowClass))
                throw new InvalidConfigException('Enter Class for load languages array for ex \amass\langprettyurl\Component.');

            /* @var Component $data */
            $data = Yii::createObject([
                'class' => $this->allowClass,
            ]);
            $this->languages = $data->languages;
        }

        if ($this->enableLocaleUrls && $this->languages) {
            if (!$this->enablePrettyUrl) {
                throw new InvalidConfigException('Locale URL support requires enablePrettyUrl to be set to true.');
            }
        }
        $this->_defaultLanguage = Yii::$app->language;
    }

    /**
     * Validate a single extension dependency
     *
     * @param string $name the extension class name (without vendor namespace prefix)
     * @param mixed  $repo the extension package repository names (without vendor name prefix)
     * @param string $reason a user friendly message for dependency validation failure
     *
     * @throws InvalidConfigException if extension fails dependency validation
     */
    public static function checkDependency($name = '', $repo = '', $reason = '')
    {
        if (empty($name)) {
            return;
        }
        $command = "php composer.phar require " . $repo;
        $version = ": \"@dev-master\"";
        $class = $name;

        $repos = "the '" . $repo . "' extension. ";

        $installs = $command . $version;

        if (!class_exists($class)) {
            throw new InvalidConfigException(
                "The class '{$class}' was not found and is required {$reason}.\n\n" .
                "Please ensure you have installed {$repos}" .
                "To install, you can run this console command from your application root:\n\n{$installs}"
            );
        }
    }
}