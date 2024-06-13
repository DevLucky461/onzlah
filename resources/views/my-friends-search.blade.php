@extends('layouts.app')

@section('prescript')
@endsection

@section('content')
<div class="scroller w-100">
    <div class="container-fluid main-header-bg">
        <div class="row pt-5">
            <div class="col-2 text-left pt-2">
                <a href="/my-friends"><img src="{{url('/assets2/icon/left-arrow.png')}}" alt=""></a>
            </div>
            <div class="col-8 text-center ">
                <p class="font-Montserrat-ExtraBold font-size-28px FFEF41-color ">SEARCH FRIEND</p>
            </div>
            <div class="col-2 text-center">
               
            </div>
        </div>
    </div>

    <div class="container-fluid bg-yellow-content light-yellow-dots-bg" style="min-height:90vh">


        <div class="row">
            <div class="col-md-12 py-3" >
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

    function deleteFriend(id) {

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ url('/delete-friends') }}",
                    method: 'post',
                    data: {
                        "id": id,
                    },
                    success: function (result) {

                        console.log();
                        //$('#tr-'+result.id).hide();
                        if (result.user == "deleted successfully") {

                            $('#tr-'+result.id).attr("style", "display: none !important") ;
                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'Friend successfully deleted',
                                'success'
                            ).then((result) => {
                                
                            })

                        }
                        if (result.user == "Can't find the friend") {
                            swalWithBootstrapButtons.fire(
                                'Cancelled',
                                'Cant find the friend ',
                                'error'
                            )
                        }
                    }
                });

            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your friend is safe :)',
                    'error'
                )
            }
        })
    }


    function search_friends() {
        //console.log($('#search_friends').val());\

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{ url('/search-new-friends') }}",
            method: 'post',
            data: {
                "search_data": $('#search_friends').val(),
            },
            success: function (result) {
                //var i = 0;
                $('#tbody_search').empty();
                //console.log(result.user.length);
                if (result.user.length > 0) {
                    $.each(result.user, function () {
                        $('#tbody_search').append(
                            "<tr class='d-flex' id='tr" + this.id +"'> "+
                            "<td class='col-3 font-NunitoSans-SemiBold font-size-20px text-black'><div class='table-image-user'><img src="+this.picture+" alt='' class='w-100 h-100' style='object-fit: cover;''></div> </td>"+
                            "<td class='col-6 font-NunitoSans-SemiBold font-size-20px text-black text=left'><div class='position-relative h-100'><div class='position-absolute' style='top: 50%;transform: translateY(-50%);'>" + this.name +"</div></div></td>"+ 
                            "<td class='col-3 font-NunitoSans-SemiBold font-size-20px text-black text-right pr-0'>" +
                            "<button  class='btn bg-lime button-border-custom font-Montserrat font-size-18px' onclick='addFriend(" +
                            this.id + ")'>ADD</button></td></tr>")
                    });
                } else {
                    $('#tbody_search').empty();
                }
            }
        });
    } 

    function addFriend(id) {
        //console.log(i);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ url('/add-new-friends') }}",
            method: 'post',
            data: {
                "friend_id": id,
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

@endsection
