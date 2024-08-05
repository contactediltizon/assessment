@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Yum! Brands</h1>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ request('brand') === 'all' ? 'active' : '' }}" href="?brand=all">All Brands</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('brand') === 'Taco Bell' ? 'active' : '' }}" href="?brand=Taco Bell">Taco Bell</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('brand') === 'kfc' ? 'active' : '' }}" href="?brand=kfc">KFC</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('brand') === 'Pizza Hut' ? 'active' : '' }}" href="?brand=Pizza Hut">Pizza Hut</a>
        </li>
    </ul>
    
   

    <div class="row mt-3">
        @forelse($stores as $store)
            @if(request('brand') === 'all' || strtolower(request('brand')) === strtolower($store->brand))
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $store->brand }}</h5>
                            <p class="card-text">
                                Store Number: {{ $store->store_number }}<br>
                                Address: {{ $store->address }}<br>
                                Total Revenue: {{ $store->total_revenue }}<br>
                                Total Profit: {{ $store->total_profit }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        @empty
            <p>No stores available for the selected brandss.</p>
        @endforelse
    </div>
     <!-- Export Form -->
     <form action="{{ url('/stores/export') }}" method="POST" class="mt-3">
        @csrf
        <input type="hidden" name="brand" value="{{ request('brand') }}">
        <button type="submit" class="btn btn-primary">Export Data</button>
    </form>
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
</div>
@endsection
