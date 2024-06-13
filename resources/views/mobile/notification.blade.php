@extends('layouts.mobile')

@section('prescript')
<style>
    .scroller{
        height: 100% !important;
    }
</style>
@endsection

@section('content')

<div class="scroller w-100 bg-color-EAEAEA">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 p-3 notification" style="min-height: 40rem">

                @if (count($notiArray) == 0)
                <div class="notification-box-wrapper p-3 mb-3 w-100" >
                    <p class="font-size-18px font-NunitoSans-SemiBold text-dark line-height-normal">
                       No Notification Data</p>
                    <p class="font-size-13px font-NunitoSans-Regular text-dark"></p>
                    
                </div>
                @else
                @foreach ($notiArray as $item)
                    @if ($item['status'] == "unread")
                        <div class="notification-box-wrapper p-3 mb-3 w-100" onclick="update_notification_status({{$item['id']}})" >
                            <p class="font-size-18px font-NunitoSans-SemiBold text-dark line-height-normal">
                                {{$item['notification']}}</p>
                            <p class="font-size-13px font-NunitoSans-Regular text-dark">{{$item['time_difference']}}</p>
                           
                            <div class="position-relative pb-2">
                                <div class="badges position-absolute" id="badges-{{$item['id']}}"></div>
                            </div>
                            
                        </div>
                    @else
                        <div class="notification-box-wrapper p-3 mb-3 w-100" >
                            <p class="font-size-18px font-NunitoSans-SemiBold text-dark line-height-normal">
                                {{$item['notification']}}</p>
                            <p class="font-size-13px font-NunitoSans-Regular text-dark">{{$item['time_difference']}}</p>
                        </div>
                    @endif              
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

@section('postscript')
<script>

    $(document).ready(function () {
    });

    function update_notification_status(id) {

        //console.log(id);

        $('#badges-'+id).fadeOut();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{ url('/api/update-notification_status') }}",
            method: 'post',
            data: {
                'id': id,
            },
            success: function (response) {
                //location.reload();
            }
        }); 

        
    }

</script>
@endsection
