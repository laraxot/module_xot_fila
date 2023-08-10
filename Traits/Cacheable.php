<?php

declare(strict_types=1);

namespace Modules\Xot\Traits;

use Carbon\Carbon;
use Illuminate\Cache\CacheManager;
use Illuminate\Database\Eloquent\Model;

/**
 * Trait Cacheable.
 */
trait Cacheable
{
    /**
     * Cache instance.
     */
    protected static ?CacheManager $cache = null;

    /**
     * Flush the cache after create/update/delete events.
     */
    protected bool $eventFlushCache = false;

    /**
     * Global lifetime of the cache.
     */
    protected int $cacheMinutes = 60;

    /**
     * Set cache manager.
     */
    public static function setCacheInstance(CacheManager $cache): void
    {
        self::$cache = $cache;
    }

    /**
     * Get cache manager.
     */
    public static function getCacheInstance(): CacheManager
    {
        if (self::$cache === null) {
            self::$cache = app('cache');
        }

        return self::$cache;
    }

    /**
     * Determine if the cache will be skipped.
     */
    public function skippedCache(): bool
    {
        return config('repositories.cache_enabled', false) === false
            || app('request')->has(config('repositories.cache_skip_param', 'skipCache')) === true;
    }

    /**
     * Get Cache key for the method.
     */
    public function getCacheKey(string $method, $args, string $tag): string
    {
        // Sort through arguments
        foreach ($args as &$a) {
            if ($a instanceof Model) {
                $a = $a::class.'|'.$a->getKey();
            }
        }

        // Create hash from arguments and query
        $args = serialize($args).serialize($this->getScopeQuery());

        return sprintf(
            '%s-%s@%s-%s',
            config('app.locale'),
            $tag,
            $method,
            md5($args)
        );
    }

    /**
     * Get an item from the cache, or store the default value.
     */
    public function cacheCallback(string $method, array $args, \Closure $callback, mixed $time = null)
    {
        // Cache disabled, just execute query & return result
        if ($this->skippedCache() === true) {
            return \call_user_func($callback);
        }

        // Use the called class name as the tag
        $tag = static::class;

        return self::getCacheInstance()->tags(['repositories', $tag])->remember(
            $this->getCacheKey($method, $args, $tag),
            $this->getCacheExpiresTime($time),
            $callback
        );
    }

    /**
     * Flush the cache for the given repository.
     */
    public function flushCache(): bool
    {
        // Cache disabled, just ignore this
        if ($this->eventFlushCache === false || config('repositories.cache_enabled', false) === false) {
            return false;
        }

        // Use the called class name as the tag
        $tag = static::class;

        return self::getCacheInstance()->tags(['repositories', $tag])->flush();
    }

    /**
     * Return the time until expires in minutes.
     */
    protected function getCacheExpiresTime(?int $time = null): int
    {
        if ($time === self::EXPIRES_END_OF_DAY) {
            return class_exists(Carbon::class)
                ? round(Carbon::now()->secondsUntilEndOfDay() / 60)
                : $this->cacheMinutes;
        }

        return $time ? $time : $this->cacheMinutes;
    }
}
