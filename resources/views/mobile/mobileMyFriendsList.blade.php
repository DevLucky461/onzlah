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
                <div class="col-12 ">
                    <table class="table  table-borderless mb-0" id='listtable'>
                        <tbody class='font-markerfelt'>
                            @if (count($friendlist) == 0)
                            <tr class='d-flex'  id="zero-listtable">
                                <td class="col-12 text-center ">
                                    <span class="font-NunitoSans-SemiBold font-size-20px ">No friends :(</span>
                                </td>
                            </tr>
                            @else
                                @foreach($friendlist->sortByDesc('coins') as $list)
                                <tr class='d-flex' id="tr-{{$list->id}}">
                                    <td class="col-3 img-center-content pr-0">
                                        <div class="table-image-user">
                                            <img src="/{{$list->picture}}" class="w-100 h-100" alt="" style="object-fit: cover">
                                        </div>
                                    </td>
                                    <td class='col-6 text-black pl-0'> 
                                        <span class="font-NunitoSans-SemiBold font-size-20px ">{{$list->name}} </span>
                                    <td class='col-3 font-size-13px text-black text-right'>
                                        <button
                                            class='btn bg-gray-content button-border-custom font-markerfelt font-size-18px text-dark'
                                            onclick="deleteFriend( {{$list->id}} , {{$user_id}} )"><i class="fa fa-times"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('postscript')
    <script>
        $(document).ready(function () {
           // console.log({{$user_id}});
            
            $('#requsttable').hide();
            $('#requsttable2').hide();
            $('#to-be-approved').hide();
            $('#waiting-approval').hide();
            $('#listtable').show();

            $('#btn-list').on('click', function () {
                $(this).addClass('border-bottom-black')
                $('#btn-request').removeClass('border-bottom-black');
                $('#listtable').show();

            if($('#listtable').is(":visible")){
                    $('#requsttable').hide();
                    $('#requsttable2').hide();
                    $('#to-be-approved').hide();
                    $('#waiting-approval').hide();
            }else{
                    $('#requsttable').hide();
                    $('#requsttable2').hide();
                    $('#to-be-approved').hide();
                    $('#waiting-approval').hide();
            };
            })

            $('#btn-request').on('click', function () {
                $(this).addClass('border-bottom-black');
                $('#btn-list').removeClass('border-bottom-black');
                
                $('#requsttable').show();
                $('#requsttable2').show();
                $('#to-be-approved').show();
                $('#waiting-approval').show();

                if($('#requsttable').is(":visible")){
                    $('#listtable').hide();
            }else{
                    $('#listtable').hide();
            };
            })
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

        function deleteFriend(friend_id, user_id) {

           // console.log(friend_id,user_id);
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
                        url: "{{ url('/api/deleteFriend') }}",
                        method: 'post',
                        data: {
                            "friend_id": friend_id,
                            "user_id": user_id,
                        },
                        success: function (result) {
                            //console.log();
                            //$('#tr-'+result.id).hide();
                            if (result.user == "Friend deleted successfully") {

                                //$('#tr-'+result.id).attr("style", "display: none !important") ;
                                swalWithBootstrapButtons.fire(
                                    'Deleted!',
                                    'Friend successfully deleted',
                                    'success'
                                ).then((result) => {
                                    location.reload();
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
                    //Read more about handling dismissals below 
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
    </script>
@endsection