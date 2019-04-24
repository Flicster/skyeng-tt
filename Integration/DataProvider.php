<?php
namespace App\Integration;

class DataProvider implements IDataProvider
{
    /** @var string */
    private $host;
    /** @var string */
    private $user;
    /** @var string */
    private $password;

    /**
     * @param $host
     * @param $user
     * @param $password
     */
    public function __construct($host, $user, $password)
    {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * @param array $parameters
     * @return array
     */
    public function request(array $parameters): array
    {
        // returns a response from external service
        return [];
    }
}
