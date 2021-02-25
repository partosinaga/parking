@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    hi {{ Auth::user()->name }}, you can change basic parking rate per hour in <a href="{{ route('rate') }}">here</a>, current rate per hour  IDR {{ number_format($rate->rate) }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
