<?php
namespace App\Integration;

interface IDataProvider
{
    public function request(array $parameters): array;
}
