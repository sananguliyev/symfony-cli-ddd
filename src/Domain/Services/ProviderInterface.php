<?php

namespace Webbala\Domain\Services;

/**
 * Interface ProviderInterface
 * @package Webbala\Domain\Services
 */
interface ProviderInterface
{
    /**
     * @param string $date
     * @param string $base
     * @param array $symbols
     * @return array
     */
    public function getRates(string $date, string $base, array $symbols);
}