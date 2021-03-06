<?php

namespace Kalessil\Composer\Plugins\ProductionDependenciesGuard;

final class Repository
{
    private static $vendors  = [
        'phpunit/',
        'codeception/',
        'behat/',
        'phpspec/',
        'phpstan/',
    ];

    private static $packages = [
        'kalessil/production-dependencies-guard',
        'roave/security-advisories',

        /* PhpUnit-extensions and tooling */
        'johnkary/phpunit-speedtrap',
        'brianium/paratest',
        'mybuilder/phpunit-accelerator',
        'codedungeon/phpunit-result-printer',
        'spatie/phpunit-watcher',
        'satooshi/php-coveralls',
        
        /* Frameworks components and tooling */
        'symfony/phpunit-bridge',
        'symfony/debug',
        'symfony/var-dumper',
        'symfony/maker-bundle',
        'zendframework/zend-test',
        'zendframework/zend-debug',
        'yiisoft/yii2-gii',
        'yiisoft/yii2-debug',
        'orchestra/testbench',
        'barryvdh/laravel-debugbar',
        'filp/whoops',
        'fzaninotto/faker',

        /* dev-tools */
        'humbug/humbug',
        'infection/infection',
        'mockery/mockery',
        'mikey179/vfsStream',
        'phing/phing',

        /* SCA and code quality tools */
        'friendsofphp/php-cs-fixer',
        'vimeo/psalm',
        'jakub-onderka/php-parallel-lint',
        'squizlabs/php_codesniffer',
        'slevomat/coding-standard',
        'doctrine/coding-standard',
        'zendframework/zend-coding-standard',
        'yiisoft/yii2-coding-standards',
        'wp-coding-standards/wpcs',
        'phpcompatibility/php-compatibility',
        'phpmd/phpmd',
        'pdepend/pdepend',
        'sebastian/phpcpd',
        'povils/phpmnd',
        'phan/phan',
        'phpro/grumphp',
        'wimg/php-compatibility',
        'sstalle/php7cc',
    ];

    private function containsByVendor(string $dependency): bool {
        $callback = static function (string $vendor) use ($dependency): bool { return stripos($dependency, $vendor) === 0; };
        return array_filter(self::$vendors, $callback) !== [];
    }

    public function contains(string $dependency): bool {
        return \in_array(strtolower($dependency), self::$packages, true) || $this->containsByVendor($dependency);
    }
}