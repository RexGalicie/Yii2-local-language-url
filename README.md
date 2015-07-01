Yii2 Language Pretty Local Url
==============================
Yii2 Language Pretty Local Url

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist amass/local-language-url "*"
```

or add

```
"amass/local-language-url": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

 'component' => [
  .....
     'urlManager' => [
        'class' => 'amass\langprettyurl\UrlManager',
		/**if you use yii2-translate-manager https://github.com/lajax/yii2-translate-manager*/
        'allowClass' => 'amass\langprettyurl\Component',
		/* or */
		'languages' => ['uk' => 'uk-UA']
     ],
  .....
 ]