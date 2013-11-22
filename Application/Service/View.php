<?php

namespace Service;

/**
 * 
 * @author leandro <leandro@leandroleite.info>
 */
abstract class View {

    protected static $templatePath;
    protected static $baseView = 'index';
    protected static $ext = '.php';
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

    public static function setExtension($ext) {
        self::$ext = $ext;
    }

    public static function render() {
        self::dispatchRoutines();
        extract(self::$data);
        $file = self::getFullPath();

        if (!is_file($file)) {
            throw new \Exception("File '{$file}' not exists", 1);
            exit;
        }
        require $file;
    }

    public static function getFullPath() {
        return self::$templatePath . DIRECTORY_SEPARATOR . self::$baseView . self::$ext;
    }

    public static function redirect($url) {
        header("Location: {$url}");
        exit;
    }

    public static function addRoutineToExecuteBeforeRender(callable $function) {
        self::$before[] = $function;
    }

    protected static function dispatchRoutines() {
        foreach (self::$before as $function) $function();
    }

    public static function addSubPage($subpage) {
        extract(self::$data);
        $subpage = str_replace('_', DIRECTORY_SEPARATOR, $subpage) . self::$ext;
        require self::$templatePath . DIRECTORY_SEPARATOR . $subpage;
    }

}