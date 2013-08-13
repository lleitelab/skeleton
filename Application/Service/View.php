<?php

namespace Service;

/**
 * 
 * @author leandro <leandro@leandroleite.info>
 */
abstract class View {

    const EXT = '.php';

    protected static $templatePath;
    protected static $baseView = 'index';
    protected static $data = array();
    protected static $before = array();

    public static function set($name, $content = null) {
        self::$data[$name] = $content;
    }

    public static function get($name) {
        return self::$data[$name];
    }

    public static function exists($name) {
        return isset(self::$data[$name]);
    }

    public static function setTemplatePath($path) {
        self::$templatePath = $path;
    }

    public static function setBaseView($baseView) {
        self::$baseView = $baseView;
    }

    public static function render() {
        self::dispatchRoutines();
        extract(self::$data);
        $file = self::$templatePath . DIRECTORY_SEPARATOR
                . self::$baseView . self::EXT;

        if (!is_file($file)) {
            echo "File '{$file}' not exists";
            exit;
        }
        require $file;
    }

    public static function redirect($url) {
        header("Location: {$url}");
        exit;
    }

    public static function addRoutineToExecuteBeforeRender(callable $function) {
        self::$before[] = $function;
    }

    protected static function dispatchRoutines() {
        foreach (self::$before as $function)
            $function();
    }

    public static function add($subpage) {
        extract(self::$data);
        $subpage = str_replace('_', DIRECTORY_SEPARATOR, $subpage) . self::EXT;
        require self::$templatePath . DIRECTORY_SEPARATOR . $subpage;
    }

}