<?php
namespace Core;

class Request
{
    public static $instance;
    public $done = false;
    public $errors = [];

    
    protected function __construct() {
    }

    protected function __clone() {
    }

    public function __wakeup() {
        throw new \Exception("Cannot unserialize a singleton");
    }

    public static function instance(string $validation_endpoint=null):Request {
        $cls = static::class;
        if (!isset(self::$instance)) {
            self::$instance = new static();
        }
        
     
        return self::$instance;
    }

    
}
