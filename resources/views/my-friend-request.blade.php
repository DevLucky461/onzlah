@extends('layouts.app')

@section('prescript')
@endsection

@section('content')
<div class="bg-red scroller">
    <div class="row">
        <div class="col-12 p-0">
            <img src="{{url('img/profile-banner.png')}}" class="img-fluid banner-header-full" />
        </div>
    </div>
    <div class="row">
        <div class="col-9 pt-3">
            <p class="font-markerfelt text-white font-size-25px">Friendlist</p>
        </div>
    </div>

    <div class="row py-3">
        <div class="col-12">
            <div class="scoreboard-container">
                <table class="table mb-0" id='friendscore'>
                    <tbody class='font-markerfelt'>
                        @foreach($friendlist->sortByDesc('coins') as $list)
                        <tr class='table-border-bottom d-flex'>
                            <td class='col-4 font-size-23px text-black'>{{$list->name}} </td>
                            <td class='col-4 text-center font-size-18px text-black'>{{$list->coins}}</td>
                            <td class='col-4 text-center font-size-18px text-black'>
                                <button
                                    class='btn button-color-red button-border-custom font-markerfelt font-size-18px text-white'
                                    onclick="approveFriend({{$list->id}})">Approved</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@section('postscript')
<script>
    $(document).ready(function () {

    });

    function approveFriend(id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ url('/my-friends-quest') }}",
            method: 'post',
            data: {
                "friend_id": id,
            },
            success: function (result) {
                Swal.fire({
                    title: 'Success!',
                    text: 'Friend Added',
                    icon: 'success',
                    confirmButtonText: 'Nice!'
                }).then((result) => {
                    location.reload();
                })
            }
        });
    }

</script>
@endsection


@endsection
