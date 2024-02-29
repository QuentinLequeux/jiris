<?php

namespace Core;

use JetBrains\PhpStorm\NoReturn;

class Response
{
    public const BAD_REQUEST = 400;
    public const NOT_FOUND = 404;

    #[NoReturn] public static function abort(int $code = self::NOT_FOUND): void
    {
        http_response_code($code);
        view("codes.{$code}");
        die();
    }
}