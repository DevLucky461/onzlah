@extends('layouts.blank-app')

@section('prescript')
@endsection

@section('content')
<div class="container-fluid text-white onzlah-bg scroller-nofooter">
    <div style="box-sizing: border-box;padding-top:3rem;">
        <h2 class='font-Montserrat font-size-32px FFEF41-color' class="font-Nunito-Sans"> <a href="/"><img src="{{url('/assets2/icon/left-arrow.png')}}" alt=""></a>PASSWORD RESET</h2><br>
            <div class='text-center form-group'>
                <p>If your email is valid, you will receive your recovery email within a few minutes. If you have not received an email, check your spam folder or contact the OnzLAH! team for further assistance.</p>
                <a href="/login" class="btn button-yellow font-Nunito-Sans font-size-35px">RETURN TO LOGIN</a>
            </div>
    </div>
</div>
@endsection

@section('postscript')
<script>
    @if ($errors->any())
        console.log('ded');
    @elseif($status ?? '')
        console.log('notded');
    @endif
</script>
@endsection