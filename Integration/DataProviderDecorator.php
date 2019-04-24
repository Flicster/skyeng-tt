<?php
namespace src\Integration;

abstract class DataProviderDecorator implements IDataProvider
{
    /** @var IDataProvider  */
    protected $dataProvider;

    public function __construct(IDataProvider $dataProvider)
    {
        $this->dataProvider = $dataProvider;
    }
}
