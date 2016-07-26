<?php

namespace Nwidart\LaravelNormalizer\Traits;

trait CanNormalizeData
{
    /**
     * @param array $data
     * @return array
     */
    public function normalize(array $data)
    {
        foreach ($this->getNormalizers() as $normalizer) {
            $data = app($normalizer)->normalize($data);
        }

        return $data;
    }

    /**
     * @return array
     */
    public function getNormalizers()
    {
        return $this->normalizers;
    }
}
