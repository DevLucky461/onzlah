@extends('layouts.app')

@section('prescript')
@endsection

@section('content')

@if (session()->has('error_update_password'))
    <script>
        Swal.fire({
            title: 'Error!',
            text: 'Current Password and Password is the same',
            icon: 'error',
            confirmButtonText: 'Yes'
        })
    </script>
@endif

<div class="container-fluid scroller">
    <div class="container-fluid main-header-bg">
        <div class="row" style="padding-top:5rem">
            <div class="col-2 text-left  flex-center">
                <a href="/profile"><img src="{{url('/assets2/icon/left-arrow.png')}}" alt=""></a>
            </div>
            <div class="col-10 text-center ">
                <p class="font-Montserrat-ExtraBold font-size-28px FFEF41-color ">EDIT PASSWORD</p>
            </div>
        </div>
    </div>

    <form action="/update-password" method="post">
        @csrf
    <div class="row">
        <div class="col-12 px-0">
            <div class="container-fluid bg-white font-color-black p-4">
                <div class="row py-4">
                    <div class="col-12">
                        <div class="form-group">
                            <label  class="font-Nunito-Sans font-size-16px mb-0">Current Password</label>
                            <input type="password" class="form-control form-control-lg input-border " name="current_password">
                        </div>
                    </div>
                    
                    @error('current_password')
                    <div class="col-12">
                        <div class="alert alert-danger alert-dismissible fade show">{{ $message }} 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                    </div>
                    @enderror

                    <div class="col-12">
                        <div class="form-group">
                            <label class="font-Nunito-Sans font-size-16px mb-0">New Password</label>
                            <input type="password" class="form-control form-control-lg input-border"  name="password" >
                        </div>
                    </div>
                    @error('password')
                    <div class="col-12">
                         <div class="alert alert-danger alert-dismissible fade show">{{ $message }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                        </div>
                         
                    </div>
                     @enderror

                    <div class="col-12">
                        <div class="form-group">
                            <label class="font-Nunito-Sans font-size-16px mb-0">Confirm Password</label>
                            <input type="password" class="form-control form-control-lg input-border"  name="confirm_password" >
                        </div>
                    </div>

                    @error('confirm_password')
                    <div class="col-12">
                        <div class="alert alert-danger alert-dismissible fade show">{{ $message }} 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                    </div>
                    
                     @enderror
                
                </>
            </div>
            
        </div>
        <div class="col-12 text-center py-5">
            <button class="btn bg-yellow-content font-size-30px font-Montserrat-Bold btn-block" style="border: 4px solid rgb(0, 0, 0);">SAVE</button>
        </div>
    </div>
    </div>
</form>
</div>
@endsection

@section('postscript')
<script>
    $(document).ready(function () {
        $(".nav_profile").addClass("active");
        $(".footer-word-profile").addClass("active");
    });
</script>
@endsection