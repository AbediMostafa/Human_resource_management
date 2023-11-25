<?php

namespace App\Classes\auth;

use Illuminate\Support\Facades\Storage;

class Encryptor
{
    /**
     * Do a hmac hash on given vlue
     */
    public static function hashHmac($msg, $algo = 'sha256'): bool|string
    {
        return hash_hmac($algo, $msg, $msg);
    }

    /**
     * Encrypt given message with given key using sodium encryption
     */
    public static function encryptWithGivenKey($key, $msg, $toBase64 = true): string
    {
        //Get a fixed 24 byte nonce
        $nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);

        //Pad given key with space to 32 byte to be acceptable to sodium encryption
        $keyByte = str_pad($key, 32);

        $encrypted = sodium_crypto_secretbox($msg, $nonce, $keyByte);

        $saltedWithNonce = $nonce . $encrypted;

        return $toBase64 ? base64_encode($saltedWithNonce) : $saltedWithNonce;
    }

    /**
     * Decrypt given message with given key using sodium encryption
     */
    public static function decryptWithGivenKey($key, $ciphertext, $doBase64DecodeBeforeDecryption = true): string
    {
        $keyByte = str_pad($key, 32);

        $decryptedCiphertext = $doBase64DecodeBeforeDecryption ? base64_decode($ciphertext) : $ciphertext;

        //Extract nonce from given string
        $nonce = mb_substr($decryptedCiphertext, 0, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES, '8bit');

        $exactCiphertext = mb_substr($decryptedCiphertext, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES, null, '8bit');

        return sodium_crypto_secretbox_open($exactCiphertext, $nonce, $keyByte);
    }

    /**
     * Encrypts given value with stored public key
     */
    public static function encryptWithPublicKey($msg, $toBase64 = true): string
    {
        $publicKey = Storage::get('pub');
        $encrypted = sodium_crypto_box_seal($msg, base64_decode($publicKey));

        return $toBase64 ? base64_encode($encrypted) : $encrypted;
    }

    /**
     * Decrypt given value with stored keypair key pair
     */
    public static function decryptWithKeyPair($ciphertext, $doBase64DecodeBeforeDecryption = true): bool|string
    {
        $keyPair = Storage::get('keyPair');
        $encrypted = $doBase64DecodeBeforeDecryption ? base64_decode($ciphertext) : $ciphertext;

        return sodium_crypto_box_seal_open($encrypted, base64_decode($keyPair));
    }
}
