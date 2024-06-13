@extends('layouts.mobile')

@section('prescript')
<style type="text/css">
.scroller{
    height: 100% !important;
}
</style>
@endsection

@section('content')

<div class="scroller w-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 px-0">
                <div class="bg-yellow-content light-yellow-dots-bg" style="min-height: 100vh">
                    <table class="table table-borderless" id='allscore'>
                        <tbody >
                            @foreach($alllist as $list)
                            <tr class='d-flex'>
                                <td class='img-center-content font-size-25px width-3rem font-NunitoSans-ExtraBold'>
                                    @if ($loop->iteration == 1)
                                    <img src="{{url('/assets2/icon/winner-1.png')}}" alt="">
                                @elseif($loop->iteration == 2)
                                    <img src="{{url('/assets2/icon/winner-2.png')}}" alt="">

                                @elseif($loop->iteration == 3)
                                    <img src="{{url('/assets2/icon/winner-3.png')}}" alt="">
                                @else
                                    {{$loop->iteration}}
                                @endif </td>
                                    <td class="img-center-content">
                                        <div class="table-image-user">
                                            <img src="/{{$list->picture}}" class="w-100 h-100" id="profile-src"style="object-fit:cover"/>
                                        </div>
                                    </td>

                                    <td class='col-6 font-size-20px font-NunitoSans-ExtraBold'>{{$list->name}} <br> <img
                                        src="{{URL::asset('images/coin-icon.svg')}}"> <span class="violet-text-color">{{number_format($list->coins)}}</span> </td>
                                <td class="img-center-content text-right">

                                </td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="col-12 " style="height: 3rem">
                        <p class="font-NunitoSans-Italic font-size-16px text-black">* Leaderboard results will reset monthly.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
</div>

@endsection

@section('postscript')
@endsection
