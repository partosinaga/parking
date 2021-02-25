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
          
                    <form method="POST" id="form-in">
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <input type="text" class="form-control prefix" placeholder="B" maxlength="2" name="prefix" style="text-transform:uppercase" required />
                            </div>
                            <div class="form-group col-md-8">
                                <input type="text" class="form-control middle" placeholder="4804" name="middle" maxlength="4" oninput="this.value=this.value.replace(/[^0-9]/g,'');" required />
                            </div>
                            <div class="form-group col-md-2">
                                <input type="text" class="form-control suffix" placeholder="SAS" maxlength="3" name="suffix" style="text-transform:uppercase" required />
                            </div>
                            <div class="form-group col-md-12">
                                <button type="button" id="park-submit" class="btn btn-primary btn-block" width="100%"><i class="fa fa-sign-in-alt"></i> IN</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ticker modal --}}
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
                    <tr class="">
                        <td width="30%">Vehicle</td>
                        <td width="3%">:</td>
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
            <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
        </div>
        </div>
    </div>
</div>
{{-- end of ticket modal --}}

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
    $(document).ready(function() {
        // get clock
        datetimeRealtime();
        setInterval(datetimeRealtime, 1000);
        // end of get clock

        // validation
        $('input[name=prefix]').keydown(function(e) {
            alphaOnly(e);
        })
        
        $('input[name=suffix]').keydown(function(e) {
            alphaOnly(e);
        })
        // end of validation

        // post data
        $('#park-submit').click(function(e){
            var prefix = $('input[name=prefix]').val();
            var middle = $('input[name=middle]').val();
            var suffix = $('input[name=suffix]').val();
            // if()
            // {

            // }

            $('#park-submit').html('<i class="fas fa-spinner fa-spin" ></i>');
            $('#park-submit').attr('disabled', true);
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('park.in') }}",
                method: 'post',
                data: $('#form-in').serialize(),
                success: function(data){
                    if(data.success == true)
                    {
                        var content = data.data;
                        $('.vehicle').html(content.vehicle_no);
                        $('.time-in').html(content.time_in);
                        $('.code').html(content.parking_code);
                        $('.rate').html('IDR ' + addCommas(content.rate));
                        JsBarcode("#barcode", content.parking_code);
                        $('#modal-in').modal('show');
                        $('#form-in').trigger("reset");
                    }
                    if(data.success == false)
                    {
                        $('.message').html(data.data);
                        $('#alert').modal('show');
                    }
                }
            });
            $('#park-submit').html('<i class="fa fa-sign-in-alt"></i> IN');
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

    function alphaOnly(e)
    {
        var key = e.keyCode;
        if (key >= 48 && key <= 57) {
            return e.preventDefault();
        }
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