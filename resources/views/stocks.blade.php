@extends('layouts.app')

@section('title', 'Hot Stocks')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 class="mb-4">🔥 Hottest Stocks Available</h1>

        <div class="row">
            @php
            $stocks = [
                ['symbol' => 'AAPL', 'name' => 'Apple Inc.', 'price' => '173.50', 'change' => '+2.5%', 'trend' => 'up'],
                ['symbol' => 'MSFT', 'name' => 'Microsoft', 'price' => '378.85', 'change' => '+1.8%', 'trend' => 'up'],
                ['symbol' => 'GOOGL', 'name' => 'Alphabet Inc.', 'price' => '142.65', 'change' => '-0.5%', 'trend' => 'down'],
                ['symbol' => 'AMZN', 'name' => 'Amazon.com', 'price' => '178.35', 'change' => '+3.2%', 'trend' => 'up'],
                ['symbol' => 'NVDA', 'name' => 'NVIDIA Corp.', 'price' => '875.28', 'change' => '+4.1%', 'trend' => 'up'],
                ['symbol' => 'META', 'name' => 'Meta Platforms', 'price' => '505.95', 'change' => '-1.2%', 'trend' => 'down']
            ];
            @endphp

            @foreach($stocks as $stock)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $stock['symbol'] }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $stock['name'] }}</h6>
                            <p class="card-text">
                                <strong>Price:</strong> ${{ $stock['price'] }}
                                <br>
                                <span class="text-{{ $stock['trend'] === 'up' ? 'success' : 'danger' }}">
                                    {{ $stock['change'] }}
                                    <i class="bi bi-arrow-{{ $stock['trend'] }}"></i>
                                </span>
                            </p>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="alert alert-info mt-4">
            <h4 class="alert-heading">💡 Pro Tip!</h4>
            <p>Remember to diversify your portfolio and never invest more than you can afford to lose.</p>
        </div>
    </div>
</div>
@endsection
