@extends('layouts.app')
@section('prescript')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-4">
            <p>Change Question Set?</p>
        </div>
    </div>
    <div class="row">
        <div class="col-2">
            <div class="form-group">
                <select class="form-control" id="q-set" name="q-set">
                <option value="monday">Monday Set</option>
                <option value="tuesday">Tuesday Set</option>
                <option value="wednesday">Wednesday Set</option>
                <option value="thursday">Thursday Set</option>
                <option value="friday">Friday Set</option>
                </select>
            </div>
        </div>
        <div class="col-2">
            <button id="confirm" class="btn btn-danger">Confirm</button>
        </div>
    </div>
</div>
@endsection

@section('postscript')
<script>
    $('.footer-pos').hide();
    $(document).ready(()=>{
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#confirm').on('click',()=>{
            Swal.fire({
                    title: 'Are you sure?',
                    text: "This action is gonna change the question set (for rehearsal purpose only). Proceed?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Proceed'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: '{{url("/rehearsal-setquestion")}}',
                            dataType: 'json',
                            data: {
                                'set': $('#q-set').val(),
                            },
                            success: function(){
                                Swal.fire(
                                'Success!',
                                'Question set swapped.',
                                'success'
                                );
                            }
                        })
                    }
                });
            });

    });
</script>
@endsection