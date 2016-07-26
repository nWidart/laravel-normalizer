<?php

namespace Nwidart\LaravelNormalizer\Stubs;

use Nwidart\LaravelNormalizer\Contracts\Normalizer;

final class CustomNormalizer implements Normalizer
{
    /**
     * Normalize the given data
     * @param array $data
     * @return array
     */
    public function normalize(array $data) : array
    {
        if (array_key_exists('name', $data)) {
            $data['name'] = strtoupper($data['name']);
        }

        return $data;
    }
}
