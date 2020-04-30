<?php declare(strict_types=1);

namespace App\Core\DomainSupport;

use ReflectionClass;
use ReflectionException;
use Throwable;

abstract class Exception extends \Exception
{
    public function __construct($message = "", $code = 400, Throwable $previous = null)
    {
        parent::__construct(!empty($message) ? $message : $this->getMessageFromClassName(), $code, $previous);
    }

    public function getMessageFromClassName(): string
    {
        try {
            $str = (new ReflectionClass($this))->getShortName();
        } catch (ReflectionException $e) {
            return $e->getMessage() . ' - ' . $e->getCode(). "\n" . $e->getLine();
        }

        $str[0] = strtolower($str[0]);
        $func = function (array $string): string {
            return ' ' . strtolower($string[1]);
        };

        return ucfirst(preg_replace_callback('/([A-Z])/', $func, $str));
    }
}