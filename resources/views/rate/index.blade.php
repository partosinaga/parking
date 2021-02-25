@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Rate</div>

                <div class="card-body">
                   <p>basic rate for parking fee per hour</p>
                    <form action="{{ route('rate.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="sr-only" for="inlineFormInputGroupUsername">Rate</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">IDR</div>
                                </div>
                                <input type="number" name="rate" class="form-control" id="inlineFormInputGroupUsername" placeholder="3000" required value="{{ @$rate ? $rate->rate : '' }}">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
