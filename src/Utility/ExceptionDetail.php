<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 7/27/20
 * Time: 8:37 AM
 */

namespace App\Utility;

use Throwable;

/**
 * Exception detail formatter
 */
final class ExceptionDetail
{
    /**
     * Get exception text.
     *
     * @param Throwable $exception Error
     * @param int $maxLength The max length of the error message
     *
     * @return string The full error message
     */
    public static function getExceptionText(Throwable $exception, int $maxLength = 0): array
    {
        $code = $exception->getCode();
        $file = $exception->getFile();
        $line = $exception->getLine();
        $message = $exception->getMessage();
        $trace = $exception->getTraceAsString();
//        $error = sprintf('[%s] %s in %s on line %s.', $code, $message, $file, $line);
//        $error .= sprintf("\nBacktrace:\n%s", $trace);
        $arrayError = [
            'code' => $code,
            'file' => $file,
            'message' => $message
        ];

//        if ($maxLength > 0) {
//            $error = substr($error, 0, $maxLength);
//        }

        return $arrayError;
    }
}