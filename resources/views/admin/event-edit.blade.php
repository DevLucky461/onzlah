@extends('layouts.admin')

@section('contents')
<div class="row">

    <div class="col-md-12">


        <div class="py-3">
            <div class="row">
                <div class="col-md-6">
                    <p class="font-label" id="small-title"> Event Details : </p>
                </div>
                <div class="col-md-6 text-right">
                    <input type="hidden" value="{{$event['event_id']}}" id="event_id">
                </div>
            </div>

        </div>
        <div class="Question_wrapper">
            <div class="row " id="question_wrapper1">
                <div class="col-md-6">
                    <div class="card  pb-3">
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label class="font-label">Event Name</label>
                                    </div>
                                    <div class="col-8">
                                        <input type="text" class="form-control input-extra-size"
                                            placeholder="Enter the event name" id="event_name" name="event_name"
                                            value="{{$event['event_name']}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label class="font-label">Event Description</label>
                                    </div>
                                    <div class="col-8">
                                        <input type="text" class="form-control input-extra-size"
                                            placeholder="Enter the event description" id="event_desc" name="event_desc"
                                            value="{{$event['event_description']}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label class="font-label">Event Host</label>
                                    </div>
                                    <div class="col-8">
                                        <input type="text" class="form-control input-extra-size"
                                            placeholder="Enter the event host" id="event_host" name="event_host"
                                            required value="{{$event['event_host_name']}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label class="font-label">Event Start Date</label>
                                    </div>
                                    <div class="col-8">
                                        <input type="datetime-local" class="form-control input-extra-size"
                                            placeholder="Event starting date" id="start_date" name="start_date" required
                                            value="{{$event['event_start_date']}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label class="font-label">Event End Date</label>
                                    </div>
                                    <div class="col-8">
                                        <input type="datetime-local" class="form-control input-extra-size"
                                            placeholder="Enter end date" id="end_date" name="end_date" required
                                            value="{{$event['event_end_date']}}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label for="stream_key" class="font-label">Stream Key</label>
                                    </div>
                                    <div class="col-8">
                                        <input type="text" class="form-control input-extra-size"
                                            placeholder="Insert stream key" id="stream_key" name="stream_key" required
                                            value="{{$event['event_stream_key']}}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label class="font-label">Event Coins Prize</label>
                                    </div>
                                    <div class="col-8">
                                        <input type="number" id="event_coins_prize" name="event_coins_prize"
                                            class="form-control input-extra-size" placeholder="Enter Event Coins Prize"
                                            required value="{{$event['event_coins_prize_pool']}}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 text-right">
                                <button type="button" class="btn btn-primary btn-lg px-2 " id="step1_submit_from"
                                    onclick="save_details()">Save Details</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="pb-4">
                                <img src="{{$event['event_img']}}" alt="" class="file-img-size" id="img">
                            </div>


                            <div class="form-group">
                                <div class="row">
                                    <div class="col-3">
                                        <label for="end_date" class="font-label">Event Image</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="file" class="form-control-file border-input-file" id="upload"
                                            name="file_name">
                                    </div>
                                    <div class="col-md-12 text-right">
                                        <button type="button" class="btn btn-primary btn-lg px-2 "
                                            id="step1_submit_from" onclick="save_image()">Save Image</button>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>


            <div class="row pt-5">
                <div class="col-md-6 text-left">
                    <p class="font-label " id="small-title"> Question Details : </p>
                </div>
                <div class="col-md-6 text-right">
                    <button type="button" class="btn btn-secondary btn-lg " data-toggle="modal" data-target="#add_question_modal">Create Question </button>
                </div>

            </div>

            <div class="row" id="question_wrapper2">

                @foreach ($question as $q)
                <div class="col-md-6 mt-4">
                    <div class="card">
                    <div class="card-body" id="question{{$q->id}}">
                            <div class="col-md-12">
                                <div class="form-group">

                                    <label for="event_name" class="font-label">Question</label>

                                    <input type="hidden" name="question_id" value="{{$q->id}}">

                                    <input type="text" class="form-control input-extra-size question"
                                        placeholder="Enter Question" name="question" required
                                        value="{{$q->question}}">
                                </div>
                            </div>

                            @foreach ($q->answer as $answer)
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="event_name" class="font-label">Answer </label>
                                            <input type="text" class="form-control input-extra-size answer"
                                        placeholder="Enter Answer"  required name="answer"
                                                value="{{$answer->answer}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 pl-0">
                                        <div class="form-group">
                                            <label for="event_name" class="font-label">Answer Status </label>
                                            <select class="form-control input-extra-size-select w-91"
                                                name="answer_status" >

                                                @if ($answer->status == "correct")
                                                <option value="wrong">Wrong</option>
                                                <option value="correct" selected>Correct</option>
                                                @elseif($answer->status == "wrong")
                                                <option value="wrong" selected>Wrong</option>
                                                <option value="correct">Correct</option>
                                                @endif

                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            @endforeach
                            <div class="text-right mr-3">
                                <button type="button" class="btn btn-primary btn-lg " onclick="save_question({{$q->id}})">Save </button>
                                <button type="button" class="btn btn-danger btn-lg " onclick="delete_question({{$q->id}})">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <hr class="w-100">
            </div>
        </div>
    </div>

    <div class="modal fade" id="add_question_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">


                    <div class="row" id="question_wrapper2">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="event_name" class="font-label">Question</label>
                                <input type="text" class="form-control input-extra-size" placeholder="Enter Question"
                                    name="question" required id="question">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="event_name" class="font-label">Answer</label>
                                        <input type="text" class="form-control input-extra-size" placeholder="Enter Answer"
                                            name="answer" required id="answer1">
                                    </div>
                                </div>
                                    <div class="col-md-6 pl-0">
                                        <div class="form-group">
                                            <label for="event_name" class="font-label">Answer Status </label>
                                            <select class="form-control input-extra-size-select w-91" name="answer_status" id="answer_status_1">
                                                <option value="wrong" selected>Wrong</option>
                                                <option value="correct">Correct</option>
                                            </select>
                                        </div>
                                    </div>

                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="event_name" class="font-label">Answer </label>
                                        <input type="text" class="form-control input-extra-size" placeholder="Enter Answer"
                                            name="answer" required id="answer2">
                                    </div>
                                </div>
                                <div class="col-md-6 pl-0">
                                    <div class="form-group">
                                        <label for="event_name" class="font-label">Answer Status</label>
                                        <select class="form-control input-extra-size-select w-91" name="answer_status" id="answer_status_2">
                                            <option value="wrong" selected>Wrong</option>
                                            <option value="correct">Correct</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="event_name" class="font-label">Answer</label>
                                        <input type="text" class="form-control input-extra-size" placeholder="Enter Answer"
                                            name="answer" required id="answer3">
                                    </div>
                                </div>
                                <div class="col-md-6 pl-0">
                                    <div class="form-group">
                                        <label for="event_name" class="font-label">Answer Status</label>
                                        <select class="form-control input-extra-size-select w-91" name="answer_status" id="answer_status_3">
                                            <option value="wrong" selected>Wrong</option>
                                            <option value="correct">Correct</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="event_name" class="font-label">Answer</label>
                                        <input type="text" class="form-control input-extra-size" placeholder="Enter Answer"
                                            name="answer" required id="answer4">
                                    </div>
                                </div>
                                <div class="col-md-6 pl-0">
                                    <div class="form-group">
                                        <label for="event_name" class="font-label">Answer Status 4</label>
                                        <select class="form-control input-extra-size-select w-91" name="answer_status" id="answer_status_4">
                                            <option value="wrong" selected>Wrong</option>
                                            <option value="correct">Correct</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="w-100">

                        <div class="col-md-12 text-right">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-secondary" onclick="create_question()">Create</button>
                        </div>

                    </div>

            </div>

          </div>
        </div>
      </div>

</div>



<script>
    $(document).ready(function () {



        $('#upload').change(function () {

            var input = this;
            var url = $(this).val();
            var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" ||
                    ext == "jpg" || ext == "jfif")) {

                //console.log(input.files);
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                $('#img').attr('src', '/img/noimage.png');
            }
        });
    });

    function save_details() {

        if ($('#event_name').val() != "" && $('#event_desc').val() != "" &&
            $('#event_host').val() != "" && $('#start_date').val() != "" &&
            $('#end_date').val() != "" && $('#stream_key').val() != "" &&
            $('#stream_key').val() != "" && $('#event_coins_prize').val() != "") {

            var formData = new FormData();
            formData.append('save_type', 'details');
            formData.append('event_id', $('#event_id').val());
            formData.append('event_name', $('#event_name').val());
            formData.append('event_desc', $('#event_desc').val());
            formData.append('event_host', $('#event_host').val());
            formData.append('start_date', $('#start_date').val());
            formData.append('end_date', $('#end_date').val());
            formData.append('stream_key', $('#stream_key').val());
            formData.append('event_coins_prize', $('#event_coins_prize').val());


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ url('/event_save_details') }}",
                method: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function (result) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Event Details Updated',
                        icon: 'success',
                        confirmButtonText: 'Yes'
                    })
                }
            });
        } else {
            Swal.fire({
                title: 'Error!',
                text: 'Please Fill up all the required information',
                icon: 'error',
                confirmButtonText: 'Yes'
            })
        }
    }

    function save_image(){

        if ($('#upload').get(0).files.length === 0) {
            Swal.fire({
                title: 'Error!',
                text: 'Please Select one picture',
                icon: 'error',
                confirmButtonText: 'Yes'
            })
        } else {

            var formData = new FormData();
            formData.append('save_type', 'image');
            formData.append('file_name', $('input[type=file]')[0].files[0]);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ url('/event_save_details') }}",
                method: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function (result) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Event Image Updated',
                        icon: 'success',
                        confirmButtonText: 'Yes'
                    })
                }
         });
        }

    }

    function save_question(id){

        var question = $('#question'+id+ ' input[name=question]').val();
        var answer = [];
        var answer_status = [];
        var formData = new FormData();

        $('#question'+id+ ' input[name=answer]').each(function(){
            answer.push($(this).val());
        })

        $('#question'+id+ ' select[name=answer_status]').each(function(){
            answer_status.push($(this).val());

        })
        formData.append('question_id', id);
        formData.append('question', question);
        formData.append('answer', answer);
        formData.append('answer_status', answer_status);

        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ url('/event_save_question') }}",
                method: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function (result) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Event Question Updated',
                        icon: 'success',
                        confirmButtonText: 'Yes'
                    }).then((result)  => {
                        location.reload();
                    })
                }
         });

        //console.log(question, answer,answer_status );

    }

    function delete_question(id){

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ url('/event_delete_question') }}",
                    method: 'post',
                    data: {
                        "id": id,
                    },
                    success: function (result) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Event Deleted',
                            icon: 'success',
                            confirmButtonText: 'Yes'
                        }).then((result) => {
                            location.reload();
                        })
                    }
                });
            }
        })

    }

    function create_question(){
        var question = $('#add_question_modal input[name=question]').val();
        var answer = [];
        var answer_status = [];
        var formData = new FormData();

        $('#add_question_modal input[name=answer]').each(function (){
            answer.push($(this).val());
        });

        $('#add_question_modal select[name=answer_status]').each(function (){
            answer_status.push($(this).val());
        });

        formData.append('event_id', $('#event_id').val());
        formData.append('question', question);
        formData.append('answer', answer);
        formData.append('answer_status', answer_status);

        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
        $.ajax({
                url: "{{ url('/event_create_question') }}",
                method: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function (result) {
                    Swal.fire({
                        title: 'Success!',
                        text: result.data,
                        icon: 'success',
                        confirmButtonText: 'Yes'
                    }).then((result)  => {
                        location.reload();
                    })
                }
         });

        //console.log(question);
    }



</script>

@endsection
