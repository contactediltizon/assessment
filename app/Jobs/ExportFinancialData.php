<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Mail\ExportReady;
use Illuminate\Support\Facades\Mail;

class ExportFinancialData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $brand;

    public function __construct($user, $brand)
    {
        $this->user = $user;
        $this->brand = $brand;
    }

    public function handle()
    {
        try {
            $stores = $this->user->stores()->where('brand', $this->brand)->get();
            $filename = 'export_' . now()->format('Ymd_His') . '.csv';
            $filepath = 'exports/' . $filename;
            
            $csvContent = $this->generateCsvContent($stores);
            
            Storage::disk('local')->put($filepath, $csvContent);

            $fileUrl = route('exports.download', ['filename' => $filename]);

            Mail::to($this->user->email)->send(new ExportReady($fileUrl));
            
            Log::info('Export job completed successfully.');
        } catch (\Exception $e) {
            Log::error('Export job failed: ' . $e->getMessage());
        }
    }

    private function generateCsvContent($stores)
    {
        $handle = fopen('php://temp', 'r+');
        fputcsv($handle, ['Brand', 'Store Number', 'Address', 'Total Revenue', 'Total Profit']);

        foreach ($stores as $store) {
            fputcsv($handle, [
                $store->brand,
                $store->store_number,
                $store->address,
                $store->total_revenue,
                $store->total_profit,
            ]);
        }

        rewind($handle);
        $csvContent = stream_get_contents($handle);
        fclose($handle);

        return $csvContent;
    }
}


// namespace App\Jobs;

// use App\Models\Store;
// use Illuminate\Bus\Queueable;
// use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Foundation\Bus\Dispatchable;
// use Illuminate\Queue\InteractsWithQueue;
// use Illuminate\Queue\SerializesModels;
// use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Facades\Mail;
// use App\Mail\ExportReady;

// class ExportFinancialData implements ShouldQueue
// {
//     use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

//     protected $user;
//     protected $brand;

//     public function __construct($user, $brand)
//     {
//         $this->user = $user;
//         $this->brand = $brand;
//     }

//     public function handle()
//     {
//         // Fetch stores for the given user and brand
//         $storesQuery = Store::where('user_id', $this->user->id);

//         if ($this->brand !== 'all') {
//             $storesQuery->where('brand', $this->brand);
//         }

//         $stores = $storesQuery->get();

//         $filename = "financial_data_{$this->brand}_" . now()->format('Y_m_d_H_i_s') . ".csv";
//         $filepath = "exports/{$filename}";

//         // Generate CSV content
//         $csvContent = "Store Number,Address,Total Revenue,Total Profit\n";
//         foreach ($stores as $store) {
//             $csvContent .= "{$store->store_number},{$store->address},{$store->total_revenue},{$store->total_profit}\n";
//         }

//         // Store the CSV file
//         Storage::disk('local')->put($filepath, $csvContent);

//         // Send email notification
//         Mail::to($this->user->email)->send(new ExportReady($filepath));
//     }
// }

