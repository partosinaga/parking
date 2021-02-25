@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-light">
                <div class="card-header">
                    <span class="current-time"></span>
                    <span class="float-right">Rate/hour: IDR {{ number_format($rate->rate) }}</span>
                </div>

                <div class="card-body">
                    <form method="POST" id="form-out">
                        <div class="form-row">
                            
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control" placeholder="Parking Code" name="parking_code" required />
                            </div>
                            <div class="form-group col-md-12">
                                <button type="button" id="park-submit" class="btn btn-danger btn-block" width="100%"><i class="fa fa-sign-out-alt"></i> OUT</button>
                            </div>
                        </div>
                    </form>
                    <div><br>
                        <p>Recently enter</p>
                    </div>
                    <table class="table table-sm table-hover">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">Vehicle No.</th>
                            <th scope="col">Code</th>
                            <th scope="col">Rate</th>
                            <th scope="col">In</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($recently as $item)    
                                <tr>
                                    <td>{{ $item->vehicle_no }}</td>
                                    <td>{{ $item->parking_code }}</td>
                                    <td>IDR {{ number_format($item->rate) }}/hour</td>
                                    <td>{{ $item->time_in }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        <small>Page : {{ !! $recently->currentPage() }}  Total Records : {{ $recently->total() }} </small>
                        <div class="d-flex justify-content-center float-right">
                            {!! $recently->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-in" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Success</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <table class="table table-sm table-borderless">
                    <tr>
                        <td>Vehicle</td>
                        <td>:</td>
                        <td class="vehicle"></td>
                    </tr>
                    <tr>
                        <td>Rate/hour</td>
                        <td>:</td>
                        <td class="rate"></td>
                    </tr>
                    <tr>
                        <td>In</td>
                        <td>:</td>
                        <td class="time-in"></td>
                    </tr>
                    <tr>
                        <td>Out</td>
                        <td>:</td>
                        <td class="time-out"></td>
                    </tr>
                    <tr>
                        <td>Duration</td>
                        <td>:</td>
                        <td class="duration"></td>
                    </tr>
                    <tr>
                        <td>Cost</td>
                        <td>:</td>
                        <td class="cost"></td>
                    </tr>
                    <tr>
                        <td>Code</td>
                        <td>:</td>
                        <td class="code"></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-center">
                            <canvas id="barcode"></canvas>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-2"></div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">OK</button>
        </div>
        </div>
    </div>
</div>

{{-- alert modal --}}
<div class="modal" tabindex="-1" role="dialog" id="alert">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Failed</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p class="message"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
{{-- end of alert modal --}}
@endsection
@push('footer_scripts')
<script>
   $('document').ready(function() {
        // get clock
        datetimeRealtime();
        setInterval(datetimeRealtime, 1000);
        // end of get clock

         // post data
         $('#park-submit').click(function(e){
            $('#park-submit').html('<i class="fas fa-spinner fa-spin" ></i>');
            $('#park-submit').attr('disabled', true);
            
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('park.out') }}",
                method: 'post',
                data: $('#form-out').serialize(),
                success: function(resp){
                    if(resp.success == true)
                    {
                        var content = resp.data.in;
                        $('.vehicle').html(content.vehicle_no);
                        $('.time-in').html(content.time_in);
                        $('.code').html(content.parking_code);
                        $('.time-out').html(content.time_out);
                        $('.duration').html(resp.data.duration);
                        $('.cost').html('IDR ' + addCommas(resp.data.cost));
                        $('.rate').html('IDR ' + addCommas(content.rate));
                        JsBarcode("#barcode", content.parking_code);
                        $('#modal-in').modal('show');
                        $('#form-out').trigger("reset");
                    }
                    if(resp.success == false)
                    {
                        $('.message').html(resp.data);
                        $('#alert').modal('show');
                    }
                }
            });
            $('#park-submit').html('<i class="fa fa-sign-in-alt"></i> OUT');
            $('#park-submit').attr('disabled', false);
        });
        // end of post data

    })
    function datetimeRealtime() {
        var d = new Date();
        var month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        var date = d.getDate() + " " + month[d.getMonth()] + "  " + d.getFullYear();
        var time = d.toLocaleTimeString();
        $('.current-time').text(date +' - '+ time);
    }
    function addCommas(nStr)
    {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }
</script>
@endpush