<?php

namespace Core\initial\Classes;

class CFiles {
    const string ABSPATH = __DIR__ . '/../../phpCMS/';

    const string CONTROLLERS = self::ABSPATH.'controllers/';
    const string EXECUTORS = self::ABSPATH.'executors/';

    const string LIBS = self::ABSPATH.'lib/';

    const string MEDIA_JS = self::ABSPATH.'media/js/';
    const string MEDIA_CSS = self::ABSPATH.'media/sassConstruct/';
    const string MEDIA_IMG = self::ABSPATH.'media/img/';

    const string ELEMENTS = self::ABSPATH.'elements/';
    const string VIEW = self::ABSPATH.'view/';

    const string LANG = self::ABSPATH.'lang/';
    public static string $LANG_FOLDER = self::ABSPATH.'lang/';

    const string DATA = self::ABSPATH.'data/';
    const string DATA_LIBS = self::ABSPATH.'data/libs/';
    const string DATA_LOGS = self::ABSPATH.'data/logs/';
    const string DATA_SECURE = self::ABSPATH.'secure_data/';

    public static function setLangFolder(string $lang): void {
        self::$LANG_FOLDER = self::LANG.$lang.'/';
    }
}