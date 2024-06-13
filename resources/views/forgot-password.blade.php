@extends('layouts.blank-app')

@section('prescript')
@endsection

@section('content')
<div class="container-fluid text-white onzlah-bg scroller-nofooter">
    <div style="box-sizing: border-box;padding-top:3rem;">
        <h2 class='font-Montserrat font-size-32px FFEF41-color' class="font-Nunito-Sans"> <a href="/"><img src="{{url('/assets2/icon/left-arrow.png')}}" alt=""></a>FORGOT PASSWORD</h2><br>
        <form action="/forgot-password-request" method="POST">
            @csrf
            <div class="form-group">
                <label for="username" class=" font-size-14px font-Montserrat">Email</label>
                <input type="text" class="form-control input-extra-size input-sharp" placeholder="Enter your registered email" id="email" name="email" required>
            </div>
            <div class='text-center form-group'>
                <button type="submit" class="btn button-yellow font-Nunito-Sans font-size-35px">SUBMIT</button>
            </div>
        </form>
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