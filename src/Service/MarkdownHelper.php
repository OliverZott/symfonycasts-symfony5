<?php


namespace App\Service;


use Psr\Cache\InvalidArgumentException;
use Symfony\Contracts\Cache\CacheInterface;

class MarkdownHelper
{

    private CacheInterface $cache;

    public function __construct(CacheInterface $cache)
    {
        $this->cache = $cache;
    }


    /**
     * @param string $source
     * @return string
     * @throws InvalidArgumentException
     */
    public function parse(string $source): string
    {
        return $this->cache->get(
            'markdown_' . md5($source),
            function () use ($source) {
                return 'PARSED: ' . $source;
            }
        );
    }

}
