<?php

namespace App\Casts;

use \App\Classes\auth\Encryptor as EncryptorClass;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class Encryptor implements CastsAttributes
{

    public function __construct(private $key)
    {}
    /**
     * Cast the given value.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function get($model, string $key, $value, array $attributes)
    {
        return EncryptorClass::decryptWithGivenKey($this->key, $value);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function set($model, string $key, $value, array $attributes)
    {
        return $value;
    }
}
