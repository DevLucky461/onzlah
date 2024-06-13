@extends('layouts.app')

@section('prescript')
@endsection

@section('content')
<div class="container-fluid bg-red scroller">
    <div class="row">
        <div class="col-12 header-blue back-padding">
            <a href='{{url()->previous()}}'><i class="las la-angle-left la-2x text-white"></i><span class="font-markerfelt font-size-22px text-white">Back</span></a>
        </div>
    </div>
    <div class="row">
        <div class="col-12 pt-3">
            <p class="font-markerfelt text-white font-size-25px">My Coins Log:</p>
            <p class="font-markerfelt text-white font-size-20px" id="coins">My current balance: {{auth()->user()->coins}}</p>
        </div>
    </div>
    <div class="row py-3">
        <div class="col-12">
            <div class="coins-container">
                <table class="table">
                    <thead class='font-markerfelt'>
                        <tr class='table-border-bottom-coins'>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Coins</th>
                        </tr>
                    </thead>
                    <tbody id="trans-table" class='font-markerfelt'>
                        @foreach ($transaction as $t)
                            <tr class='table-border-bottom-coins'>
                                <td>{{Carbon\Carbon::parse($t->created_at)->format('d/M/Y')}}</td>
                                <td><a id="trans-{{$loop->index}}" href="#" style="color: black">{{$t->transaction_type}}</a></td>
                                <td>{{$t->transaction_value}}</td>
                                <input id="trans-{{$loop->index}}-val" type="hidden" value="{{$t->id}}">
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="transaction-modal">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content modal-border mx-4">
            <div class="modal-body font-color-black text-center">
                <p id="modal-header" class="font-markerfelt font-size-22px">tron</p>
                <p id="modal-body" class="font-latobold font-size-18px"></p>
                <button type="button" class="btn button-no font-komikaaxis font-size-13px text-white my-3 ml-2 py-2" data-dismiss="modal">Back</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('postscript')
    <script>
        $(document).ready(()=>{
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#trans-table").on('click','a',(e)=>{
                $.ajax({
                    url: "{{ url('get-transaction') }}",
                    method: 'post',
                    data: {
                        'transaction_id': $(e.target).parent().siblings('input').val(),
                    },

                    success: function (response) {
                        $('#modal-body').html(response.message);
                        $('#transaction-modal').modal('toggle');
                    }
                });
            });
        });
    </script>
@endsection
