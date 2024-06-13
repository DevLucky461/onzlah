@extends('layouts.mobile')

@section('prescript')
<style>
    .scroller{
        height: 100% !important;
    }
</style>
@endsection

@section('content')

<div class="container-fluid scroller">

        <div class="row p-2 font-color-black">
            <div class="col-12">
                <p class="font-NunitoSans-Regular font-size-16px pt-20px">
                    Share your feedback to us. We may featured your words on our social media platform and you can get FREE 1 Life.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group feedback-question-box">
                    <p class="feedback-question d-flex"><span class="col-1">1.</span><span class="col-11 ml-neg10"> Hey! How was your PLAY! EARN! SPEND! experience with us?</span></p>
                    <div class="row text-center plr-37px">
                        <div class="col">
                            <input type="radio" id="q1-great" name="q1" value="3" required>
                            <span class="radio-btn"></span>
                        </div>
                        <div class="col">
                            <input type="radio" id="q1-average" name="q1" value="2">
                            <span class="radio-btn"></span>
                        </div>
                        <div class="col">
                            <input type="radio" id="q1-disappointing" name="q1" value="1">
                            <span class="radio-btn"></span>
                        </div>
                    </div>
                    <div class="row plr-37px">
                        <div class="col-12 text-center mt-9px">
                            <div class="row">
                                <div class="col">
                                    <label class="cursor-pointer" for="q1-great">Great</label>
                                </div>
                                <div class="col">
                                    <label class="cursor-pointer" for="q1-average">Average</label>
                                </div>
                                <div class="col">
                                    <label class="cursor-pointer" for="q1-disappointing">Disappointing</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group feedback-question-box">
                    <p class="feedback-question d-flex"><span class="col-1">2.</span><span class="col-11 ml-neg10"> How would you rate our app?<span class="feedback-question-small"> [Scale of 1 (okay) - 5 (excellent)]</span></span></p>
                    <div class="row text-center plr-37px">
                        <div class="col">
                            <input type="radio" id="q2-1" name="q2" value="1" required>
                            <span class="radio-btn"></span>
                        </div>
                        <div class="col">
                            <input type="radio" id="q2-2" name="q2" value="2">
                            <span class="radio-btn"></span>
                        </div>
                        <div class="col">
                            <input type="radio" id="q2-3" name="q2" value="3">
                            <span class="radio-btn"></span>
                        </div>
                        <div class="col">
                            <input type="radio" id="q2-4" name="q2" value="4">
                            <span class="radio-btn"></span>
                        </div>
                        <div class="col">
                            <input type="radio" id="q2-5" name="q2" value="5">
                            <span class="radio-btn"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center mt-9px">
                            <div class="row plr-37px">
                                <div class="col">
                                    <label class="cursor-pointer" for="q2-1">1</label>
                                </div>
                                <div class="col">
                                    <label class="cursor-pointer" for="q2-2">2</label>
                                </div>
                                <div class="col">
                                    <label class="cursor-pointer" for="q2-3">3</label>
                                </div>
                                <div class="col">
                                    <label class="cursor-pointer" for="q2-4">4</label>
                                </div>
                                <div class="col">
                                    <label class="cursor-pointer" for="q2-5">5</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group feedback-question-box">
                    <p class="feedback-question d-flex"><span class="col-1">3.</span><span class="col-11 ml-neg10"> How often do you play OnzLAH! in a week?<span class="feedback-question-small">[Scale of 1 (okay) - 5 (excellent)]</span></span></p>
                    <div class="row text-center plr-37px">
                        <div class="col">
                            <input type="radio" id="q3-1" name="q3" value="1" required>
                            <span class="radio-btn"></span>
                        </div>
                        <div class="col">
                            <input type="radio" id="q3-2" name="q3" value="2">
                            <span class="radio-btn"></span>
                        </div>
                        <div class="col">
                            <input type="radio" id="q3-3" name="q3" value="3">
                            <span class="radio-btn"></span>
                        </div>
                        <div class="col">
                            <input type="radio" id="q3-4" name="q3" value="4">
                            <span class="radio-btn"></span>
                        </div>
                        <div class="col">
                            <input type="radio" id="q3-5" name="q3" value="5">
                            <span class="radio-btn"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center mt-9px">
                            <div class="row plr-37px">
                                <div class="col">
                                    <label class="cursor-pointer" for="q3-1">1</label>
                                </div>
                                <div class="col">
                                    <label class="cursor-pointer" for="q3-2">2</label>
                                </div>
                                <div class="col">
                                    <label class="cursor-pointer" for="q3-3">3</label>
                                </div>
                                <div class="col">
                                    <label class="cursor-pointer" for="q3-4">4</label>
                                </div>
                                <div class="col">
                                    <label class="cursor-pointer" for="q3-5">5</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group feedback-question-box">
                    <p class="feedback-question d-flex"><span class="col-1">4.</span><span class="col-11 ml-neg10"> LOVE US? How likely are you to recommend this app to a friend or colleague?</span></p>

                    <div class="row text-center plr-37px">
                        <div class="col">
                            <input type="radio" id="q4-1" name="q4" value="1" required>
                            <span class="radio-btn"></span>
                        </div>
                        <div class="col">
                            <input type="radio" id="q4-2" name="q4" value="2">
                            <span class="radio-btn"></span>
                        </div>
                        <div class="col">
                            <input type="radio" id="q4-3" name="q4" value="3">
                            <span class="radio-btn"></span>
                        </div>
                        <div class="col">
                            <input type="radio" id="q4-4" name="q4" value="4">
                            <span class="radio-btn"></span>
                        </div>
                        <div class="col">
                            <input type="radio" id="q4-5" name="q4" value="5">
                            <span class="radio-btn"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center mt-9px">
                            <div class="row plr-37px">
                                <div class="col">
                                    <label class="cursor-pointer" for="q4-1">1</label>
                                </div>
                                <div class="col">
                                    <label class="cursor-pointer" for="q4-2">2</label>
                                </div>
                                <div class="col">
                                    <label class="cursor-pointer" for="q4-3">3</label>
                                </div>
                                <div class="col">
                                    <label class="cursor-pointer" for="q4-4">4</label>
                                </div>
                                <div class="col">
                                    <label class="cursor-pointer" for="q4-5">5</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group feedback-question-box">
                    <p class="feedback-question d-flex"><span class="col-1">5.</span><span class="col-11 ml-neg10"> Tell us what you love about the app, or what we could be doing better?</span></p>
                    <textarea class="form-control feedback-textarea offset-1 col-10" name="q5" rows="4" required></textarea>
                </div>
            </div>
        </div>

        <input type="hidden" value="{{$user_id}}" name="user_id">

     
        
        <div class="col-12 text-center pb-5 mt-15px">
            <button class="btn bg-yellow-content font-size-30px font-Montserrat-Bold btn-block feedback-submit" onclick="create_feedback()">SUBMIT</button>
        </div>
    
</div>
@section('postscript')
<script>
    function create_feedback(){
        var user_id = $('input[name=user_id]').val();
        var q5 = $('textarea[name=q5]').val();
        var q4 = $("input[name='q4']:checked").val();
        var q3 = $("input[name='q3']:checked").val();
        var q2 = $("input[name='q2']:checked").val();
        var q1 = $("input[name='q1']:checked").val();

        console.log(user_id, q5, q4, q3, q2, q1);

        $.ajax({
            url: "{{ url('/api/create_feedback_mobile') }}",
            method: 'post',
            data: {
                'user_id': user_id,
                "q1" : q1,
                "q2" : q2,
                "q3" : q3,
                "q4" : q4,
                "q5" : q5,
            },
            success: function (response) {
                Swal.fire({
                    title: 'Success!',
                    text: 'Your feedback has been recorded. Thank you!',
                    icon: 'success',
                    confirmButtonText: 'Okay'
                }).then((result) => {  
                   location.reload();
                });
            }
        }); 
    }
</script>
@endsection

@endsection