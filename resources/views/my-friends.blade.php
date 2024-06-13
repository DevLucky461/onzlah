@extends('layouts.app')

@section('prescript')
@endsection

@section('content')
<div class="scroller w-100">
    <div class="container-fluid main-header-bg">
        <div class="row pt-5">
            <div class="col-2 text-left pt-2">
                <a href="/main"><img src="{{url('/assets2/icon/left-arrow.png')}}" alt=""></a>
            </div>
            <div class="col-8 text-center ">
                <p class="font-Montserrat-ExtraBold font-size-28px FFEF41-color "> MY FRIENDS</p>
            </div>
            <div class="col-2 text-center">
                <a href="/my-friends-search"><img src="{{url('/assets2/icon/Group_22654-white.png')}}" alt="" ></a>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-5 pr-0">
                <button id="btn-list" type="button"
                    class="btn  font-Montserrat font-size-20px FFEF41-color border-bottom-black">LIST</button>
            </div>

            <div class="col-7 px-0">
                <button id="btn-request" type="button" class="btn font-Montserrat font-size-20px FFEF41-color">FRIEND
                    REQUEST</button>
            </div>
        </div>

        <!--<div class="row py-4">
            <div class="col-9 pr-0">
                <input type="text" class="w-100 fill-height" id="searchkey" name="search_key" placeholder="Enter Name.."
                    onkeyup="myFunction()">
            </div>
            <div class="col-3 ">
                <button type="button"
                    class="btn button-color-yellow button-border-custom font-markerfelt font-size-18px w-100">Search</button>
            </div>
        </div> -->
    </div>

    <div class="container-fluid bg-yellow-content light-yellow-dots-bg" style="min-height:90vh">
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
                                            <img src="{{$list->picture}}" class="w-100 h-100" alt="" style="object-fit: cover">
                                        </div>
                                    </td>
                                    <td class='col-6 text-black pl-0'> 
                                        <span class="font-NunitoSans-SemiBold font-size-20px ">{{$list->name}} </span>
                                    <td class='col-3 font-size-13px text-black text-right'>
                                        <button
                                            class='btn bg-gray-content button-border-custom font-markerfelt font-size-18px text-dark'
                                            onclick="deleteFriend({{$list->id}})"><i class="fa fa-times"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                            
                           
                        </tbody>
                    </table>

                </div>
                <div class="col-12">
                    <div class="col-12 mt-3" id="waiting-approval">
                        <h2 class="font-Montserrat font-color-black font-size-24px mb-0">Waiting for My Approval</h2>
                        <div class="text-left">
                            <hr class="hr-pink">
                        </div>    
                    </div>
                    <table class="table  table-borderless mb-0" id='requsttable' >
                        <tbody class='font-markerfelt'>
                            @if (count($unapprove) == 0)
                                <tr id="zero-requesttable">
                                    <td class="col-12 text-center ">
                                        <span class="font-NunitoSans-SemiBold font-size-20px "> No friend requests</span>
                                    </td>
                                </tr>
                            @else

                            @foreach($unapprove as $list)
                            @if ($list['status'] == "unapproved")
                            <tr class="d-flex" id="tr-{{$list['user']->id}}">
                                <td class="col-3 img-center-content pr-0">
                                    <div class="table-image-user">
                                      <img src="{{$list['user']->picture}}" class="w-100 h-100" alt="" style="object-fit: cover">
                                    </div>
                                </td>
                                <td class='col-3 text-black pl-0'> 
                                   <span class="font-NunitoSans-SemiBold font-size-20px ">{{$list['user']->name}} </span>
                                <td class='col-6 font-size-13px text-black text-right'>
                                 
                                   
                                    <button class='btn button-color-lime button-border-custom font-markerfelt font-size-18px text-dark'
                                    onclick="approveFriend({{$list['user']->id}})"><i class="fa fa-check"></i></button>

                                    <button
                                    class='btn bg-gray-content button-border-custom font-markerfelt font-size-18px tex-dark'
                                    onclick="deleteFriend({{$list['user']->id}})"><i class="fa fa-times"></i></button> 
                                   
                                   
                                </td>
                            </tr>
                            @endif
                            @endforeach
                            @endif
                        </tbody>
                    </table>


                    <div class="col-12 mt-3" id="to-be-approved">
                        <h2 class="font-Montserrat font-color-black font-size-24px mb-0">To Be Approved</h2>
                        <div class="text-left">
                            <hr class="hr-blue">
                        </div>    
                    </div>


                    <table class="table  table-borderless mb-0" id='requsttable2' >
                        <tbody class='font-markerfelt'>
                            @if (count($unapprove) == 0)
                                <tr id="zero-requesttable">
                                    <td class="col-12 text-center">
                                        <span class="font-NunitoSans-SemiBold font-size-20px ">No friend requests</span>
                                    </td>
                                </tr>
                            @else

                            @foreach($unapprove as $list)
                            

                            @if($list['status'] == "waiting")
                            <tr class="d-flex" id="tr-{{$list['user']->id}}">
                                <td class="col-3 img-center-content pr-0">
                                    <div class="table-image-user">
                                      <img src="{{$list['user']->picture}}" class="w-100 h-100" alt="" style="object-fit: cover">
                                    </div>
                                </td>
                                <td class='col-3 text-black pl-0'> 
                                   <span class="font-NunitoSans-SemiBold font-size-20px ">{{$list['user']->name}} </span>  <br>
                                    <span class="font-NunitoSans-Regular font-size-13px "> online </span></td>
                                <td class='col-6 font-size-13px text-black text-right'>
                                  
                                    <button
                                        class='btn bg-gray-content button-border-custom font-Montserrat-ExtraBold font-size-12px '
                                            onclick="deleteFriend({{$list['user']->id}})">Cancel <br> Request</button> 
                                   
                                </td>
                            </tr>
                            @endif
                            @endforeach
                            @endif
                        </tbody>
                    </table>
               
            </div>
        </div>
    </div>
  
</div>





@section('postscript')
<script>
    $(document).ready(function () {
       
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

                console.log(result.user);
                    
                    $('table#listtable tbody').append('<tr class="d-flex" id="tr-'+result.user.id+'">'+
                        '<td class="col-3 img-center-content pr-0"><div class="table-image-user"><img src="'+result.user.picture+'" class="w-100 h-100" alt="" style="object-fit: cover">'+
                        '</div></td><td class="col-6 text-black pl-0"> <span class="font-NunitoSans-SemiBold font-size-20px ">'+result.user.name+'</span><br><span class="font-NunitoSans-Regular font-size-13px "> online </span></td>'+
                        '<td class="col-3 font-size-13px text-black text-right"><button class="btn button-color-red button-border-custom font-markerfelt font-size-18px text-white" onclick="deleteFriend('+result.user.id+')">'+
                        '<i class="fa fa-times"></i></button></td></tr>');
                    
                    $('#zero-listtable').attr("style", "display: none !important");

                    $('table#requsttable #tr-'+result.user.id).attr("style", "display: none !important") ;

                    //$('#zero-listtable').hide();
                    //$('table#listtable').show();
                Swal.fire({
                    title: 'Success!',
                    text: 'Friend Added',
                    icon: 'success',
                    confirmButtonText: 'Yes'
                }).then((result2) => {

                })
            }
        });
    }

</script>
@endsection


@endsection
