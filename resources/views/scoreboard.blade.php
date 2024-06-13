@extends('layouts.app')

@section('prescript')
<style type="text/css">

</style>
@endsection

@section('content')

<div class="scroller w-100">
    <div class="container-fluid main-header-bg">
        <div class="row pt-5">
            <div class="col-2 text-left pt-2">
                <a href="/main"><img src="{{url('/assets2/icon/left-arrow.png')}}" alt=""></a>
            </div>
            <div class="col-8 text-center ">
                <p class="font-Montserrat-ExtraBold font-size-28px FFEF41-color ">LEADERBOARD</p>
            </div>
            <div class="col-2 text-center">
               
            </div>
        </div>
        <div class="row text-center">
            <div class="col-6 pr-0">
                <button id="btn-friend" type="button"
                    class="btn  font-Montserrat font-size-20px FFEF41-color border-bottom-black">FRIENDS</button>
            </div>

            <div class="col-6 pl-0">
                <button id="btn-all" type="button"
                    class="btn font-Montserrat font-size-20px FFEF41-color">NATIONWIDE</button>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 px-0">
                <div class="bg-yellow-content light-yellow-dots-bg" style="min-height: 100vh">
                    <table class="table table-borderless" id='friendscore'>
                        <tbody >
                            @foreach($friendlist->sortByDesc('coins')->take(10) as $list)
                            <tr class='d-flex'>
                                <td class='img-center-content font-size-25px width-3rem font-NunitoSans-ExtraBold' > 
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
                                        <img src="{{$list->picture}}" class="w-100 h-100" id="profile-src" style="object-fit:cover"/>
                                    </div>
                                </td>
                                <td class='col-6 font-size-20px font-NunitoSans-ExtraBold'>{{$list->name}} <br> <img
                                    src="{{URL::asset('images/coin-icon.svg')}}"> <span class="violet-text-color">{{number_format($list->coins)}}</span> </td>
                                    <td class="img-center-content">
                                        
                                    </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
                                            <img src="{{$list->picture}}" class="w-100 h-100" id="profile-src"style="object-fit:cover"/>
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
<script>
    $(document).ready(function () {

         $('#allscore').hide();
        $('#btn-friend').on('click', function () {
            $(this).addClass('border-bottom-black')
            $('#btn-all').removeClass('border-bottom-black');
            $('#allscore').toggle();

           if($('#friendscore').is(":visible")){
                $('#allscore').toggle();
           }else{
                $('#friendscore').toggle();
           };
       
        })

        $('#btn-all').on('click', function () {
            $(this).addClass('border-bottom-black');
            $('#btn-friend').removeClass('border-bottom-black');
            
            $('#friendscore').toggle();

            if($('#allscore').is(":visible")){
                $('#friendscore').toggle();
           }else{
                $('#allscore').toggle();
           };
        })
    })

</script>
@endsection
