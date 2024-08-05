<?php

namespace App\Http\Controllers;
use App\Jobs\ExportFinancialData;
use Illuminate\Http\Request;
use App\Models\Store;
class StoreController extends Controller
{
    
    public function export(Request $request)
    {
        $brand = $request->input('brand');
        $user = auth()->user();

        ExportFinancialData::dispatch($user, $brand);
     
        return back()->with('status', 'Export started. You will receive an email once it is ready.');
    }
  


    public function index()
    {
        $user = auth()->user();
        $query = $user->stores(); // Assuming a relationship between User and Store

        $brand = request('brand');

        // Debugging output
        // dd($brand);
         // Debugging output
        // dd($brand, $query->toSql(), $query->getBindings());
        if ($brand && $brand !== 'all') {
            // Case-insensitive search for brand
            $stores = $query->whereRaw('LOWER(brand) = ?', [strtolower($brand)])->get();
        } else {
            $stores = $query->get(); // Fetch all stores if no filter is applied
        }

        return view('stores.index', compact('stores'));
    }
    // public function show($id)
    // {
    //     $store = Store::findOrFail($id);
    //     $financialDetails = $store->financialDetails()->where('date', '>=', now()->subYear())->get(); // Get details for the last year

    //     return view('stores.show', compact('store', 'financialDetails'));
    // }
    public function show($id)
    {
    

        $store = Store::find($id);

        if (!$store) {
            return abort(404, 'Store not found');
        }

        $financialDetails = $store->financialDetails()->where('date', '>=', now()->subYear())->get();

        return view('stores.show', compact('store', 'financialDetails'));
    }





    




}
