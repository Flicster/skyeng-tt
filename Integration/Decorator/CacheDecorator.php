<?php
namespace src\Integration\Decorator;

use src\Integration\DataProviderDecorator;
use src\Integration\IDataProvider;
use Psr\Cache\CacheItemPoolInterface;

class CacheDecorator extends DataProviderDecorator {
    /** @var CacheItemPoolInterface  */
    public $cache;

    /**
     * @param IDataProvider $dataProvider
     * @param CacheItemPoolInterface $cache
     */
    public function __construct(IDataProvider $dataProvider, CacheItemPoolInterface $cache)
    {
        parent::__construct($dataProvider);
        $this->cache = $cache;
    }

    /**
     * @param array $parameters
     * @return array
     * @throws
     */
    public function request(array $parameters): array
    {
        $cacheKey = $this->getCacheKeyBy($parameters);
        $cachedResponseItem = $this->cache->getItem($cacheKey);
        if ($cachedResponseItem->isHit()) {
            return $cachedResponseItem->get();
        }

        $response = $this->dataProvider->request($parameters);

        $cachedResponseItem
            ->set($response)
            ->expiresAt(
                (new \DateTime())->modify('+1 day')
            );

        $this->cache->save($cachedResponseItem);

        return $response;
    }

    /**
     * @param array $parameters
     * @return string
     */
    private function getCacheKeyBy(array $parameters): string
    {
        return $parameters['endpoint'];
    }
}
