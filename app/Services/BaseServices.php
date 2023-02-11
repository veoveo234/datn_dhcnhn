<?php

namespace App\Services;

use App\Traits\HandleImage;
use Illuminate\Http\FileHelpers;

/**
 * Class BaseServices.
 *
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 * @link      https://laravel.com Laravel(tm) Project
 */
abstract class BaseServices
{
    use HandleImage,FileHelpers;
    /**
     * @param string $message
     * @return array
     */
    public function returnError($message = ''): array
    {
        return [
            'success' => false,
            'message' => $message,
        ];
    }

    /**
     * @param array $data
     * @param string $message
     * @return array
     */
    public function returnSuccess($data = [], $message = ''): array
    {
        return [
            'data' => $data,
            'success' => true,
            'message' => $message,
        ];
    }
}
