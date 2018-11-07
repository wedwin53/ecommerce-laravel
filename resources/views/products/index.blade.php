@extends('layouts.app');

@section('content')
    <div class="container">
        <div class="row">
        @foreach ($products as $product)
        <div class="col-xs-12 col-sm-6 col-md-4">
            <div class="card">
                <header>
                    <a href="/productos/{{$product->id}}">
                        <h2 class="card-title">{{ $product->title }}</h2>
                    </a>
                    <h4 class="card-subtitle">{{ $product->price }}</h4>
                </header>
                <p class="card-text">{{ $product->description }}</p>
            </div>   
        </div>
            
        @endforeach
        </div>
        <div class="text-center">
            {{ $products->links() }}
        </div>
    </div>
@endsection