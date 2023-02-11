<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhoneRegex implements Rule
{
    protected $prefixTenNumbers = '09|03|07|08|05';
    protected $errorType;

    protected const ERROR_TYPE_FORMAT = 1;
    protected const ERROR_TYPE_NUMERIC = 2;
    protected const ERROR_TYPE_LENGTH = 3;

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return preg_match('/^(\+84|0)([0-9]{9})$/', $value);
    }


    public function validate($attribute, $value): bool
    {
        return $this->passes($attribute, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'Số điện thoại không đúng định dạng';
    }
}
