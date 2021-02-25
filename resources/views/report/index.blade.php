@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-light">
                <div class="card-header">
                    <span class="current-time">Parking Report</span>
                    <span class="float-right">Rate/hour: IDR {{ number_format($rate->rate) }}</span>
                </div>

                <div class="card-body">
                    <form method="GET" id="form-out" action="{{ route('action.report') }}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="">Filter Data:</label>
                            </div>
                            <div class="form-group col-md-12">
                                <select name="filter_by" id="" class="form-control" required>
                                    <option value="" disabled selected>Filter by</option>
                                    <option value="time_in" {{ @$_GET['filter_by'] == 'time_in' ? 'selected' : '' }} >Time in</option>
                                    <option value="time_out" {{ @$_GET['filter_by'] == 'time_out' ? 'selected' : '' }} >Time out</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" placeholder="Date from" name="from" id="from" readonly value="{{ @$_GET['from'] }}" required />
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" placeholder="Date to" name="to" id="to" readonly value="{{ @$_GET['to'] }}" required />
                            </div>

                            <div class="form-group col-md-4">
                                <button type="submit" name="action" value="filter" class="btn btn-primary btn-block" width="100%">Filter</button>
                            </div>
                            <div class="form-group col-md-4">
                                <a href="{{ route('export') }}"><button type="button" name="action" value="export" class="btn btn-success btn-block" width="100%">Export all</button></a>
                            </div>
                            <div class="form-group col-md-4">
                               <a href="{{ route('report') }}"> <button type="button" name="action" value="export" class="btn btn-danger btn-block" width="100%">Reset</button></a>
                            </div>
                        </div>
                    </form>
                    <div><br>
                    </div>
                    <table class="table table-sm table-hover">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">Vehicle</th>
                            <th scope="col">Code</th>
                            <th scope="col">Rate</th>
                            <th scope="col">In</th>
                            <th scope="col">Out</th>
                            <th scope="col">Duration</th>
                            <th scope="col">Cost</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)    
                                <tr>
                                    <td>{{ $item->vehicle_no }}</td>
                                    <td>{{ $item->parking_code }}</td>
                                    <td>{{ number_format($item->rate) }}</td>
                                    <td>{{ $item->time_in }}</td>
                                    <td>{{ $item->time_out }}</td>
                                    <td>{{ $item->duration }}</td>
                                    <td>{{ number_format($item->cost) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        <small>Page : {{ !! $data->currentPage() }}  Total Records : {{ $data->total() }} </small>
                        <div class="d-flex justify-content-center float-right">
                            {!! $data->links() !!}
                        </div>
                    </div>
                
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('footer_scripts')
<script>
    $('#from').datepicker({
    });
    $('#to').datepicker({
    });
    $('document').ready(function(){
        $('.datepicker').datepicker();

    })
</script>
@endpush