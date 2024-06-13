@extends('layouts.app')

@section('prescript')

@endsection

@section('content')

@if (session()->has("success"))
<script>
    Swal.fire({
        title: 'Success!',
        text: 'we will get back to you as soon as possible',
        icon: 'success',
        confirmButtonText: 'Yes'
    });

</script>
@else

@endif
<div class="scroller pl-0 pr-0">
    <div class="container-fluid ">
        <div class="row pt-5 main-header-bg">
            <div class="col-2 text-left pt-2">
                <a href="/profile"><img src="{{url('/assets2/icon/left-arrow.png')}}" alt=""></a>
            </div>
            <div class="col-10 text-center pl-0 ">
                <p class="font-Montserrat-ExtraBold font-size-28px FFEF41-color">BECOME A PARTNER</p>
            </div>
        </div>

        <div class="row bg-white">
            <div class="col-12 py-4 ">
                <p class="font-NunitoSans-Regular font-size-16px mb-0 font-color-black"></p>
            </div>
        </div>
        <form action="/create_partner" method="post">
            @csrf
            <div class="row">
                <div class="col-12 ">
                    <div class="form-group">
                        <label for="password" class="font-Nunito-Sans font-size-16px mb-0 font-color-black">Name</label>
                        <input type="text" name="name" class="form-control form-control-lg input-border">
                    </div>
                </div>

                @error('name')
                <div class="col-12">
                    <div class="alert alert-danger">{{ $message }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button></div>
                </div>
                @enderror
                <div class="col-12">
                    <div class="form-group">
                        <label class="font-Nunito-Sans font-size-16px mb-0 font-color-black">Company</label>
                        <input type="text" name="company" class="form-control form-control-lg input-border">
                    </div>
                </div>

                @error('company')
                <div class="col-12">
                    <div class="alert alert-danger">{{ $message }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                @enderror
                <div class="col-12">
                    <div class="form-group">
                        <label class="font-Nunito-Sans font-size-16px mb-0 font-color-black">Position</label>
                        <input type="text" name="position" class="form-control form-control-lg input-border"></div>
                </div>

                @error('position')
                <div class="col-12">
                    <div class="alert alert-danger">{{ $message }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                @enderror

                <div class="col-12">
                    <div class="form-group">
                        <label class="font-Nunito-Sans font-size-16px mb-0 font-color-black">Contact Number</label>
                        <input type="text" name="contact_number" class="form-control form-control-lg input-border">
                    </div>
                </div>

                @error('contact_number')
                <div class="col-12">
                    <div class="alert alert-danger">{{ $message }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                @enderror

                <div class="col-12">
                    <div class="form-group">
                        <label class="font-Nunito-Sans font-size-16px mb-0 font-color-black">Email</label>
                        <input type="email" name="email" class="form-control form-control-lg input-border"></div>
                </div>

                @error('email')
                <div class="col-12">
                    <div class="alert alert-danger">{{ $message }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                @enderror
                <div class="col-12 text-center py-3"><button type="submit"
                        class="btn bg-yellow-content font-size-30px font-Montserrat-Bold btn-block"
                        style="border: 4px solid rgb(0, 0, 0);">SUBMIT</button>
                </div>
        </form>
    </div>
    
</div>
</div>

@section('postscript')
<script>

</script>
@endsection
@endsection
