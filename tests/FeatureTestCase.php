<?php

declare(strict_types=1);

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Carbon;
use Tests\Traits\InteractsWithYearPeriods;
use Toby\Eloquent\Models\BenefitsReport;

abstract class FeatureTestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }
}
