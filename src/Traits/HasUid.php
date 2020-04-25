<?php

namespace Ollico\Uid\Traits;

use Hashids\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

trait HasUid
{
    /**
     * Generate and fill the Uid when the model is being created.
     * @return void
     */
    public static function bootHasUid(): void
    {
        static::creating(function (Model $model) {
            if (!$model->uid) {
                $model->uid = self::generateUid();
            }
        });
    }

    /**
     * Scope by uid.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $uid
     * @return void
     */
    public function scopeUid($query, $uid): void
    {
        $query->where('uid', $uid);
    }

    /**
     * Generate an unique uid.
     *
     * @return string
     */
    private static function generateUid(): string
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
    private static function getSalt(): string
    {
        return Config::get('uid.salt', '');
    }

    /**
     * Get 'minLength' from config of its default value.
     *
     * @return string
     */
    private static function getMinLength(): int
    {
        return (int) Config::get('uid.min_length', 0);
    }

    /**
     * Get 'alphabet' from config of its default value.
     *
     * @return string
     */
    private static function getAlphabet(): string
    {
        return Config::get('uid.alphabet', 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890');
    }

    /**
     * Generate a integer number based in microtime.
     *
     * @return int
     */
    private static function getMicrotimeAsInteger(): int
    {
        return (int) (10000*microtime(true));
    }
}
