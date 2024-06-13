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
        <div class="container-fluid bg-yellow-content light-yellow-dots-bg" style="min-height:100vh">
            <div class="row">
                <div class="col-md-12 py-3">
                    <input type="text" class="w-100 fill-height font-NunitoSans-SemiBold font-size-18px pl-3" id="search_friends" name="search_key" style="border: 3px solid #000;"
                    placeholder="Search Username" onkeyup="search_friends()">
                </div>
            </div>
            <div class="row">
                <div class="col-12 ">
                    <div class="">
                        <table class="table table-borderless mb-0">
                            <tbody class='font-markerfelt' id="tbody_search">

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('postscript')
<script>
    $(document).ready(function () {
    });

    const Toast = Swal.mixin({
        toast: true,
        position: 'bottom-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        onOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })

    function search_friends() {
        console.log($('#search_friends').val());
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });

        $.ajax({
            url: "{{ url('/api/searchFriend') }}",
            method: 'post',
            data: {
                "search_data": $('#search_friends').val(),
                "user_id" : {{$user_id}}
            },
            success: function (result) {
                //var i = 0;
                $('#tbody_search').empty();
                //console.log(result.user.length);
                if (result.user.length > 0) {
                    $.each(result.user, function () {
                        $('#tbody_search').append(
                            "<tr class='d-flex' id='tr" + this.id +"'> "+
                            "<td class='col-3 font-NunitoSans-SemiBold font-size-20px text-black'><div class='table-image-user'><img src='/"+this.picture+"' alt='' class='w-100 h-100' style='object-fit: cover;''></div> </td>"+
                            "<td class='col-6 font-NunitoSans-SemiBold font-size-20px text-black text=left'><div class='position-relative h-100'><div class='position-absolute' style='top: 50%;transform: translateY(-50%);'>" + this.name +"</div></div></td>"+ 
                            "<td class='col-3 font-NunitoSans-SemiBold font-size-20px text-black text-right pr-0'>" +
                            "<button  class='btn bg-lime button-border-custom font-Montserrat font-size-18px' onclick='addFriend(" +
                            this.id + ", {{$user_id}})'>ADD</button></td></tr>")
                    });
                } else {
                    $('#tbody_search').empty();
                }
            }
        });
    } 

    function addFriend(friend_id, user_id) {
        console.log(friend_id, user_id);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ url('/api/addFriend') }}",
            method: 'post',
            data: {
                "user_id": user_id,
                "friend_id": friend_id,
            },
            success: function (result) {
                //console.log($('#tr'+id).hide());
                console.log(result.user);
                if (result.message == "waiting to be approved") {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Friend request sent.',
                        icon: 'success',
                        confirmButtonText: 'Yes'
                    }).then((result) => {
                                    location.reload();
                    })
                }
                if (result.message == "Both of u already friends") {
                }
                $('#tr' + id).attr("style", "display: none !important")
            }
        });
    }
</script>
@endsection