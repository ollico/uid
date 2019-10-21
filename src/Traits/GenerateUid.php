<?php

namespace WeAreAlgomas\Uid\Traits;

use Illuminate\Database\Eloquent\Model;
use Hashids\Hashids;

trait HasUid
{
    /**
     * Generate an unique uid.
     *
     * @return string
     */
    public static function generateUid()
    {
        $uid = (new Hashids(self::getSalt(), self::getMinLength(), self::getAlphabet()))
            ->encode(self::getMicrotimeAsInteger());

        if (self::uid($uid)->count() > 0) {
            return static::generateUid();
        }

        return $uid;
    }

    /**
     * Get 'salt' from config of its default value.
     *
     * @return string
     */
    private static function getSalt()
    {
        return config('database.uid.salt', '');
    }

    /**
     * Get 'minLength' from config of its default value.
     *
     * @return string
     */
    private static function getMinLength()
    {
        return config('database.uid.minLength', 0);
    }

    /**
     * Get 'alphabet' from config of its default value.
     *
     * @return string
     */
    private static function getAlphabet()
    {
        return config('database.uid.alphabet', 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890');
    }

    /**
     * Generate a integer number based in microtime.
     *
     * @return int
     */
    private static function getMicrotimeAsInteger()
    {
        return (int) (10000 * microtime(true));
    }
}
