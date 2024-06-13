@extends('layouts.blank-app')

@section('prescript')
    <style>
        input[type=text] {
            padding: 10px;
            margin: 1px;
            border: 1px solid #ddd;
            width: 50px;
            height: 65px;
            text-align: center;
            font-size: 25px;
            border-radius: 5px;
        }
    </style>
@endsection

@section('content')

<div class="container-fluid text-white onzlah-bg scroller-nofooter">
    <div class="row">
            <div class="col-12 px-4">
                <br><br>  <h2 class='font-Montserrat font-size-32px FFEF41-color'> <a href="/"><img src="{{url('/assets2/icon/left-arrow.png')}}" alt=""> </a> VERIFICATION</h2><br><br>
                <span class="font-latobold font-size-20px">To finish creating your account, enter the 6-digit verification code that we have send to your email.</span>
                <form action="/verify" method="post" class="pt-4">
                @csrf
                    <input id="digit-1" type="text" maxlength="1" />
                    <input id="digit-2" type="text" maxlength="1" />
                    <input id="digit-3" type="text" maxlength="1" />
                    <input id="digit-4" type="text" maxlength="1" />
                    <input id="digit-5" type="text" maxlength="1" />
                    <input id="digit-6" type="text" maxlength="1" />
                    <input id="digit-t" type="hidden" name="digit">
                    <input id="user_id" type="hidden" name="user_id" value="{{$user_id}}">
                    <div class='text-center position-relative w-100 height-30rem'>
                        <div class="position-absolute w-100  bottom-10px">
                            <button id="submit" type="" class="btn button-yellow font-Montserrat font-size-35px">CONFIRM</button>
                        </div>
                        
                    </div>
                </form>

            </div>

    </div>

</div>

@endsection

@section('postscript')
<script>
    $(document).ready(function(){
        $("input").keyup(function() {
            if($(this).val().length >= 1) {
                var input_flds = $(this).closest('form').find(':input');
                input_flds.eq(input_flds.index(this) + 1).focus();
            }
        });

        $('#submit').on('click',function(){
            $('#digit-t').val(
                $('#digit-1').val() +
                $('#digit-2').val() +
                $('#digit-3').val() +
                $('#digit-4').val() +
                $('#digit-5').val() +
                $('#digit-6').val()
            )
            console.log($('#digit-t').val());
        });
    })
</script>
@endsection
