@extends('layouts.app')

@section('prescript')
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: -4px;
        bottom: 0;
        background-color: #ccc;
        border: 2px solid #000;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 22px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #12FAA5;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #12FAA5;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

</style>


@endsection

@section('content')



@if(session()->has('created'))
<script>
    Swal.fire({
        title: 'success!',
        text: 'We received your feedback, Thank You',
        icon: 'success',
        confirmButtonText: 'Yes'
    })

</script>
@endif

<div class="container-fluid bg-violet scroller">
    
        <div class="row main-header-bg"  style="padding-top:5rem">
            <div class="col-2 text-left  flex-center mb-3">
                <a href="/profile"><img src="{{url('/assets2/icon/left-arrow.png')}}" alt=""></a>
            </div>
            <div class="col-10 text-center px-0">
                <p class="font-Montserrat-ExtraBold font-size-24px FFEF41-color mb-3">NOTIFICATION SETTINGS</p>
            </div>

        </div>
    

    <div class="row bg-white" style="min-height: 40rem">
        <div class="col-12 px-0">
            <div class="container-fluid font-color-black" style="min-height: 87vh">

                <table class="table table-borderless bg-white">
                    <tr>
                        <td></td>
                        <td class="font-NunitoSans-ExtraBold font-size-18px">EMAIL</td>
                        <td class="font-NunitoSans-ExtraBold font-size-18px" style="width: 100px">IN-APP</td>
                    </tr>
                    @foreach ($noti as $n)
                    <tr>
                        <td class="font-NunitoSans-SemiBold font-size-16px">{{$n->setting}}</td>

                        @if ($n->email == "true")
                        <td >
                            <label class="switch">
                                <input type="checkbox" checked onchange="checkbox(this, '{{$n->setting}}', 'email')">
                                <span class="slider"></span>
                            </label>
                        </td>
                        @elseif($n->email == "false")
                        <td>
                            <label class="switch">
                                <input type="checkbox" onchange="checkbox(this, '{{$n->setting}}', 'email')">
                                <span class="slider"></span>
                            </label>
                        </td>
                        @endif
                        

                        @if ($n->in_app == "true")
                        <td>
                            <label class="switch">
                                <input type="checkbox" checked onchange="checkbox(this, '{{$n->setting}}', 'in_app')">
                                <span class="slider"></span>
                            </label>
                        </td>

                        @elseif ($n->in_app == "false")
                        <td>
                            <label class="switch">
                                <input type="checkbox" onchange="checkbox(this, '{{$n->setting}}', 'in_app')">
                                <span class="slider"></span>
                            </label>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </table>

            </div>
        </div>
    </div>
</div>


@section('postscript')
<script>
    function checkbox(checkbox, setting, type) {

        console.log(setting , type);

        if (checkbox.checked) {
            //console.log("check");
            ajax_setup();

            $.ajax({
                url: "{{ url('/update-notification-setting') }}",
                method: 'post',
                data: {
                    "setting": setting,
                    "type": type,
                    "status": "true"
                },
                success: function (response) {
                    //location.reload();
                }
            });

        } else {

            //console.log("uncheck");
            ajax_setup();

            $.ajax({
                url: "{{ url('/update-notification-setting') }}",
                method: 'post',
                data: {
                    "setting": setting,
                    "type": type,
                    "status": "false"
                },
                success: function (response) {
                    //location.reload();
                }
            });
        } 
    }

    function ajax_setup() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    };

</script>
@endsection
@endsection
