<?php

namespace Nwidart\LaravelNormalizer\Contracts;

interface Normalizer
{
    /**
     * Normalize the given data
     * @param array $data
     * @return array
     */
    public function normalize(array $data) : array;
}
