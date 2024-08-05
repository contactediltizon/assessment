<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Store;
use App\Jobs\ExportFinancialData;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Queue;

class ExportFinancialDataTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_exports_financial_data_as_csv()
    {
        Queue::fake();
        Storage::fake('local');

        $user = User::factory()->create();
        $store = Store::factory()->create(['user_id' => $user->id]);

        ExportFinancialData::dispatch($user, $store->brand);

        Queue::assertPushed(ExportFinancialData::class);

        // Simulate job execution
        Queue::fake()->assertPushed(ExportFinancialData::class, function ($job) {
            $job->handle();
            return true;
        });

        $filePath = 'exports/financial_data_' . $store->brand . '_' . now()->format('Y_m_d_H_i_s') . '.csv';
        Storage::disk('local')->assertExists($filePath);
    }
}
