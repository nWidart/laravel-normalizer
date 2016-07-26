<?php

namespace Nwidart\LaravelNormalizer;

use Illuminate\Database\Eloquent\Model;
use Nwidart\LaravelNormalizer\Stubs\CustomNormalizer;
use Nwidart\LaravelNormalizer\Traits\CanNormalizeData;

class CanNormalizeDataTraitTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_returns_empty_array_if_no_normalizers_are_found()
    {
        $model = new class extends Model
 {
     use CanNormalizeData;
 };

        $this->assertEquals([], $model->getNormalizers());
    }

    /** @test */
    public function it_gets_all_normalizer_classes()
    {
        $model = $this->getStubbedModel();

        $this->assertCount(1, $model->getNormalizers());
    }

    /** @test */
    public function it_loops_over_normalizers()
    {
        $model = $this->getStubbedModel();

        $data = $model->normalize(['name' => 'saymyname']);

        $this->assertEquals('SAYMYNAME', $data['name']);
    }

    private function getStubbedModel()
    {
        return new class extends Model
 {
     use CanNormalizeData;
     protected $normalizers = [CustomNormalizer::class];
 };
    }
}
