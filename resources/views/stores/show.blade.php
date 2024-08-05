@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $store->brand }} - Financial Details</h1>

    <h3>Historical Data for the Last Year</h3>

    <table class="table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Revenue</th>
                <th>Food Cost</th>
                <th>Labor Cost</th>
                <th>Profit</th>
            </tr>
        </thead>
        <tbody>
            @foreach($financialDetails as $detail)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($detail->date)->format('Y-m-d') }}</td>
                    <td>${{ number_format($detail->revenue, 2) }}</td>
                    <td>${{ number_format($detail->food_cost, 2) }}</td>
                    <td>${{ number_format($detail->labor_cost, 2) }}</td>
                    <td>${{ number_format($detail->profit, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
