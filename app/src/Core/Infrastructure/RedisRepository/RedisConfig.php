<?php


namespace App\Core\Infrastructure\RedisRepository;


abstract class RedisConfig
{
    private \Redis $redis;


    public function __construct()
    {
        $this->redis = new \Redis();
        $this->redis->connect($_ENV['HOST_REDIS'], $_ENV['PORT_REDIS']);
    }

    /**
     * @param string $key
     * @param $data
     */
    final protected function createCache(string $key, $data, string $timeout): void
    {
        $this->redis->set($key, $data, $timeout);
    }

    /**
     * @param string $key
     * @return false|mixed|string
     */
    final protected function readCache(string $key)
    {
        return $this->redis->get($key);
    }

    /**
     * @param string $key
     */
    final protected function clearCache(string $key): void
    {
        $this->redis->delete($key);
    }
}