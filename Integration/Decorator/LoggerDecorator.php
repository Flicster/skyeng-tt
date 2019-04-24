<?php
namespace src\Integration\Decorator;

use src\Integration\DataProviderDecorator;
use src\Integration\IDataProvider;
use Psr\Log\LoggerInterface;

class LoggerDecorator extends DataProviderDecorator {
    /** @var LoggerInterface  */
    public $logger;

    /**
     * @param IDataProvider $dataProvider
     * @param LoggerInterface $logger
     */
    public function __construct(IDataProvider $dataProvider, LoggerInterface $logger)
    {
        parent::__construct($dataProvider);
        $this->logger = $logger;
    }

    /**
     * @param array $parameters
     * @return array
     */
    public function request(array $parameters): array
    {
        try {
            return $this->dataProvider->request($parameters);
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
        }
    }
}
