@extends('layouts.blank-app')

@section('prescript')
@endsection

@section('content')
<div class="container-fluid text-white onzlah-bg scroller-nofooter">
    <div style="box-sizing: border-box;padding-top:3rem;">
        <h2 class='font-Montserrat font-size-32px FFEF41-color' class="font-Nunito-Sans"> <a href="/"><img src="{{url('/assets2/icon/left-arrow.png')}}" alt=""></a> LOGIN</h2><br>
        <form action="/login" method="POST">
            @csrf
            <div class="form-group">
                <label for="username" class=" font-size-14px font-Montserrat">Username/Email</label>
                <input type="text" class="form-control input-extra-size input-sharp @error('username') is-invalid @enderror" placeholder="Enter your username or email" id="username" name="username" required>
                @error('username')
                    <span class="invalid-feedback pull-right" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="password" class=" font-size-14px font-Montserrat">Password</label>
                <input type="password" class="form-control input-extra-size input-sharp @error('password') is-invalid @enderror" placeholder="Enter your password" id="password" name="password" required>
                @error('password')
                    <span class="invalid-feedback pull-right" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class='text-center'>
            <p class="align-self-center"><a class="text-white text-center forgot font-size-16px font-Montserrat" href="/forgot-password">Forgot Username/Password</a></p>
            </div>
            <div class='text-center form-group'>
                <input type="hidden" name="verifycode">
                <button type="submit" class="btn button-yellow font-Nunito-Sans font-size-35px let-go-btn">LET'S GO!</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('postscript')
<script>
    @error('message')
    const Toast = Swal.mixin({
    toast: true,
    position: 'bottom-end',
    showConfirmButton: false,
    timer: 5000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
    })

    Toast.fire({
    icon: 'error',
    title: '{{$message}}'
    })
    @enderror
</script>
@endsection