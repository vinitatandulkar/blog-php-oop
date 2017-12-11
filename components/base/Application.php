<?php

namespace app\components\base;

abstract class Application extends Base {

    private static $app;
    
    /**
     * is not allowed to call from outside to prevent from creating multiple instances,
     * to use the singleton, you have to obtain the instance from Singleton::getInstance() instead
     */
    private function __construct($config = []) {

        $this->config = $config;
        Application::$app = $this;
    }

    /**
     * prevent the instance from being cloned (which would create a second instance of it)
     */
    private function __clone() {
        
    }

    /**
     * prevent from being unserialized (which would create a second instance of it)
     */
    private function __wakeup() {
        
    }

    static function app() {

        return self::$app;
    }

    public function getConfig($name) {
        return $this->config[$name];
    }

    public static function getInstance($config = []) {

        static $instance = null;

        if (null === $instance) {
            //$class = get_class($this);
            //die($class);
            //$instance = new $class();
            $instance = new static($config);
        }

        return $instance;
    }

    abstract public function run();
}

?>