@extends('layouts.admin')

@section('contents')
<div class="row">

    <div class="col-md-12">


        <div class="py-3">
            <p class="font-label" id="small-title">Step 1 : Event Details</p>
        </div>
        <div class="Question_wrapper">
            <form action="/admin-event-create" method="post" enctype="multipart/form-data" id="form1">

                <div class="row " id="question_wrapper1">

                    <div class="col-md-6">
                        <div class="card  py-4">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-4">
                                            <label class="font-label">Event Name</label>
                                        </div>
                                        <div class="col-8">
                                            <input type="text" class="form-control input-extra-size"
                                                placeholder="Enter the event name" id="event_name" name="event_name"
                                                required>
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
                                                placeholder="Enter the event description" id="event_desc"
                                                name="event_desc" required>
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
                                                required>
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
                                                placeholder="Event starting date" id="start_date" name="start_date"
                                                required>
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
                                                placeholder="Enter end date" id="end_date" name="end_date" required>
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
                                                placeholder="Insert stream key" id="stream_key" name="stream_key"
                                                required>
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
                                                class="form-control input-extra-size"
                                                placeholder="Enter Event Coins Prize" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="pb-4">
                                    <img src="{{asset('/images/no-image.png')}}" alt="" class="file-img-size" id="img">
                                </div>


                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-3">
                                            <label for="end_date" class="font-label">Event Image</label>
                                        </div>
                                        <div class="col-6">
                                            <input type="file" class="form-control-file border-input-file" id="upload"
                                                name="file_name" required>
                                        </div>
                                        <div class="col-3">
                                            <button type="button" class="btn btn-primary btn-lg"
                                                id="step1_submit_from">NEXT</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

            </form>


            <div class="row" id="question_wrapper2">
                <input type="hidden" id="event_id">
                <div class="col-md-12">
                    <div class="form-group">

                        <label for="event_name" class="font-label">Question</label>

                        <input type="text" class="form-control input-extra-size" placeholder="Enter Question"
                            name="question" required id="question">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="event_name" class="font-label">Answer 1 </label>
                                <input type="text" class="form-control input-extra-size" placeholder="Enter Answer"
                                    name="answer1" required id="answer1">
                            </div>
                        </div>
                            <div class="col-md-6 pl-0">
                                <div class="form-group">
                                    <label for="event_name" class="font-label">Answer Status 1 </label>
                                    <select class="form-control input-extra-size-select w-91" name="answer_status_1" id="answer_status_1">
                                        <option value="wrong" selected>Wrong</option>
                                        <option value="correct">Correct</option>
                                    </select>
                                </div>
                            </div>

                    </div>

                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="event_name" class="font-label">Answer </label>
                                <input type="text" class="form-control input-extra-size" placeholder="Enter Answer"
                                    name="answer2" required id="answer2">
                            </div>
                        </div>
                        <div class="col-md-6 pl-0">
                            <div class="form-group">
                                <label for="event_name" class="font-label">Answer Status 2</label>
                                <select class="form-control input-extra-size-select w-91" name="answer_status_2" id="answer_status_2">
                                    <option value="wrong" selected>Wrong</option>
                                    <option value="correct">Correct</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="event_name" class="font-label">Answer 3</label>
                                <input type="text" class="form-control input-extra-size" placeholder="Enter Answer"
                                    name="answer3" required id="answer3">
                            </div>
                        </div>
                        <div class="col-md-6 pl-0">
                            <div class="form-group">
                                <label for="event_name" class="font-label">Answer Status 3</label>
                                <select class="form-control input-extra-size-select w-91" name="answer_status_3" id="answer_status_3">
                                    <option value="wrong" selected>Wrong</option>
                                    <option value="correct">Correct</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="event_name" class="font-label">Answer 4</label>
                                <input type="text" class="form-control input-extra-size" placeholder="Enter Answer"
                                    name="answer4" required id="answer4">
                            </div>
                        </div>
                        <div class="col-md-6 pl-0">
                            <div class="form-group">
                                <label for="event_name" class="font-label">Answer Status 4</label>
                                <select class="form-control input-extra-size-select w-91" name="answer_status_4" id="answer_status_4">
                                    <option value="wrong" selected>Wrong</option>
                                    <option value="correct">Correct</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="w-100">

            </div>
            <div class="col-md-12 text-right" id="submit_wrapper">

                <button type="button" class="btn btn-primary btn-lg" onclick="addquestion()">Add
                    Question</button>
                <button type="submit" class="btn btn-lg btn-primary" onclick="finish()"> Finish</button>

            </div>


        </div>
    </div>

</div>



<script>
    $(document).ready(function () {

        $('#question_wrapper2').hide();
        $('#submit_wrapper').hide();

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

        $('#step1_submit_from').click(function () {

            if ($('#event_name').val() != "" && $('#event_desc').val() != "" &&
                $('#event_host').val() != "" && $('#start_date').val() != "" &&
                $('#end_date').val() != "" && $('#stream_key').val() != "" &&
                $('#stream_key').val() != "" && $('#event_coins_prize').val() != "") {

                var formData = new FormData();

                formData.append('event_name', $('#event_name').val());
                formData.append('event_desc', $('#event_desc').val());
                formData.append('event_host', $('#event_host').val());
                formData.append('start_date', $('#start_date').val());
                formData.append('end_date', $('#end_date').val());
                formData.append('stream_key', $('#stream_key').val());
                formData.append('event_coins_prize', $('#event_coins_prize').val());
                formData.append('file_name', $('input[type=file]')[0].files[0]);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ url('/admin-event-create') }}",
                    method: 'post',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (result) {
                        $('#event_id').val(result.event_id);
                        $('#question_wrapper1').hide();
                        $('#question_wrapper2').show();
                        $('#submit_wrapper').show();
                        $("#small-title").text("Step 2 : Question Details");
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
        });
    });


    function addquestion() {

        if ($('#event_id').val() != "" && $('#question').val() != "" && $('#answer1').val() != "" && $('#answer2').val() != "" &&
            $('#answer3').val() != "" && $('#answer4').val() != "") {
            var formData2 = new FormData();
            formData2.append('event_id', $('#event_id').val());
            formData2.append('question', $('#question').val());
            formData2.append('answer1', $('#answer1').val());
            formData2.append('answer_status_1', $('#answer_status_1').val());
            formData2.append('answer2', $('#answer2').val());
            formData2.append('answer_status_2', $('#answer_status_2').val());
            formData2.append('answer3', $('#answer3').val());
            formData2.append('answer_status_3', $('#answer_status_3').val());
            formData2.append('answer4', $('#answer4').val());
            formData2.append('answer_status_4', $('#answer_status_4').val());

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ url('/create_questions') }}",
                method: 'post',
                data: formData2,
                contentType: false,
                processData: false,
                success: function (result) {
                    //location.reload();
                    $('#question').val("");
                    $('#answer1').val("");
                    $('#answer2').val("");
                    $('#answer3').val("");
                    $('#answer4').val("");
                }
            });
        }else{
            Swal.fire({
                    title: 'Error!',
                    text: 'Please Fill up all the required information',
                    icon: 'error',
                    confirmButtonText: 'Yes'
                })
        }



    }


    function finish() {

    if ($('#event_id').val() != "" && $('#question').val() != "" && $('#answer1').val() != "" && $('#answer2').val() != "" &&
            $('#answer3').val() != "" && $('#answer4').val() != "") {

        var formData2 = new FormData();
        formData2.append('event_id', $('#event_id').val());
        formData2.append('question', $('#question').val());
        formData2.append('answer1', $('#answer1').val());
        formData2.append('answer_status_1', $('#answer_status_1').val());
        formData2.append('answer2', $('#answer2').val());
        formData2.append('answer_status_2', $('#answer_status_2').val());
        formData2.append('answer3', $('#answer3').val());
        formData2.append('answer_status_3', $('#answer_status_3').val());
        formData2.append('answer4', $('#answer4').val());
        formData2.append('answer_status_4', $('#answer_status_4').val());

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ url('/finish_questions') }}",
            method: 'post',
            data: formData2,
            contentType: false,
            processData: false,
            success: function (result) {
                //location.reload();
                Swal.fire({
                    title: 'Success!',
                    text: 'Event created with question and answer',
                    icon: 'success',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    window.location.replace("/admin-event");
                })

            }
        });

    }else{
            Swal.fire({
                    title: 'Error!',
                    text: 'Please Fill up all the required information',
                    icon: 'error',
                    confirmButtonText: 'Yes'
            })
        }

    }

</script>






@endsection
