<?php

namespace Nwidart\LaravelNormalizer\Traits;

trait CanNormalizeData
{
    /**
     * Array of data normalizers
     * @var array
     */
    protected $normalizers = [];

    /**
     * @param array $data
     * @return array
     */
    public function normalize(array $data)
    {
        foreach ($this->getNormalizers() as $normalizer) {
            $data = $normalizer->normalize($data);
        }

        return $data;
    }

    /**
     * @return array
     */
    private function getNormalizers()
    {
        return $this->normalizers;
    }
}
