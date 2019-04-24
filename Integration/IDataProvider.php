<?php
namespace src\Integration;

interface IDataProvider
{
    public function request(array $parameters): array;
}
