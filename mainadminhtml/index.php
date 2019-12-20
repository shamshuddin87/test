<?php
function sanitize_output($buffer) {

    $search = array(
        '/\>[^\S ]+/s',  // strip whitespaces after tags, except space
        '/[^\S ]+\</s',  // strip whitespaces before tags, except space
        '/(\s)+/s' ,     // shorten multiple whitespace sequences
        '/>(\s)+</',
        '/\n/',
        '/\r/',
        '/\t/',
    );

    $replace = array(
        '>',
        '<',
        '\\1',
        '><',
        '',
        '',
        '',
    );

    $buffer = preg_replace($search, $replace, $buffer);

    return $buffer;
}

//ob_start("sanitize_output");

error_reporting(E_ALL);
//ini_set("date.timezone", "Asia/Kolkata");
date_default_timezone_set("Asia/Kolkata");
use Phalcon\Mvc\Application;
use Phalcon\Config\Adapter\Ini as ConfigIni;

try {
    define('APP_PATH', realpath('..') . '/');

    /**
     * Read the configuration
     */
    $config = new ConfigIni(APP_PATH . 'app/config/config.ini');
    if (is_readable(APP_PATH . 'app/config/config.ini.dev')) {
        $override = new ConfigIni(APP_PATH . 'app/config/config.ini.dev');
        $config->merge($override);
    }

    /**
     * Auto-loader configuration
     */
    require APP_PATH . 'app/config/loader.php';

    /**
     * Load application services
     */
    require APP_PATH . 'app/config/services.php';

    $application = new Application($di);

    echo $application->handle()->getContent();
} catch (Exception $e){
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
