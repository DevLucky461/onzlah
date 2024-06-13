<?php

use App\Http\Middleware\VerifiedLogin;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/home', 'HomeController@index')->name('home');

Route::get('/register', 'Auth\RegisterController@showRegistrationForm');
Route::post('/register', 'Auth\RegisterController@register');
Route::get('/verify', 'Auth\RegisterController@viewVerify');
Route::post('/verify', 'Auth\RegisterController@verify');
Route::get('/login',['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
Route::post('/login', 'Auth\LoginController@authenticate');
Route::get('/forgot-password', 'Auth\ForgotPasswordController@view');
Route::post('/forgot-password-request', 'Auth\ForgotPasswordController@sendLink');
Route::get('/reset-password/{$token}', 'Auth\ResetPasswordController@view')->name('password.reset');
Route::post('/reset-password', 'Auth\ResetPasswordController@form')->name('password.nop');
Route::get('/logout', 'Auth\LoginController@logout');

Route::group(['middleware' => ['auth']], function(){
    Route::get('/main', 'MainController@view');
    Route::get('/scoreboard', 'ScoreboardController@view');
    Route::get('/livestage', 'StreamController@viewLivestage');
    Route::get('/stream', 'StreamController@viewStream');
    Route::get('/stream-observer', 'StreamController@viewObserver');
    Route::get('/redeem', 'RedeemController@view');
    Route::get('/reward-details/{reward_id}', 'RedeemController@viewDetails');
    Route::get('/redeem-details/{redeem_id}/{claim_id}', 'RedeemController@viewRedeemDetails');
    Route::post('/redeem-add', 'RedeemController@addVoucher');
    Route::get('/voucher/{id}', 'RedeemController@viewVoucher');
    Route::post('/reward-filter-button', 'RedeemController@rewardFilterButton');
    Route::post('/reward-filter-input', 'RedeemController@rewardFilterInput');
    Route::post('/use-reward', 'RedeemController@useReward');

    Route::get('/profile', 'ProfileController@view');
    Route::get('/edit-profile/{id}', 'ProfileController@viewEdit');
    Route::post('/edit-profile/{id}', 'ProfileController@edit');
    Route::get('/my-records', 'ProfileController@viewRecords');
    Route::get('/my-friends', 'ProfileController@viewFriends');
    Route::get('/my-qr', 'ProfileController@view_qr');
    Route::get('/my-friends-search', 'ProfileController@viewFriendSearch');
    Route::get('/my-friends/{id}', 'ProfileController@viewFriendsProfile');
    Route::post('/add-new-friends', 'ProfileController@addNewFriends');
    Route::post('/search-new-friends', 'ProfileController@searchnewfriends');
    Route::post('/delete-friends', 'ProfileController@delete');
    Route::get('/my-referral', 'ProfileController@viewReferral');
    Route::get('/how-to-play', 'ProfileController@viewHTP');
    Route::get('/contact-us', 'ProfileController@viewContact');
    Route::get('/faq', 'ProfileController@viewFAQ');

    Route::get('/qr', 'QrController@index');
    Route::get('/qr-add-friend/{id}','QrController@add_friend' );
    Route::get('/notification', 'NotificationController@index');
    Route::post('/update-notification_status', 'NotificationController@update');
    Route::get('/notification-settings', 'NotificationController@view_settings');
    Route::get('/edit-password', 'ProfileController@viewupdatepassword');
    Route::post('/update-password', 'ProfileController@updatepassword');
    Route::post('/update-profile', 'ProfileController@updateprofile');
    Route::post('/update-extra-profile', 'ProfileController@saveextraprofile');

    Route::get('/create_feedback', 'FeedbackController@index');
    Route::post('/create_feedback', 'FeedbackController@create');
    Route::post('/create_feedback_mobile', 'FeedbackController@mobile_create_feedback');

    Route::get('/policy', 'AboutController@viewPolicy');
    Route::get('/about', 'AboutController@index');
    Route::get('/become-partner', 'BecomePartnerController@index');
    Route::post('/create_partner', 'BecomePartnerController@create');

    Route::post('/update-notification-setting', 'NotificationController@update_notification_setting');

    Route::post('/add-fullname', 'ProfileController@add_fullname');
    Route::post('/add-dob', 'ProfileController@add_dob');
    Route::post('/add-current-state', 'ProfileController@add_current_state');
    Route::post('/add-current-city', 'ProfileController@add_current_city');
    Route::post('/add-gender', 'ProfileController@add_gender');

    Route::get('/coins', 'CoinController@viewCoins');
    Route::get('/my-friends-quest', 'ProfileController@viewFriendRequest');
    Route::post('/my-friends-quest', 'ProfileController@FriendRequest');
    Route::post('/send-message', 'ChatController@sendMessage');
});


Route::post('/sticker-check', 'StickerController@check');
Route::post('/sticker-update', 'StickerController@stickerUpdate');

Route::get('/overlay', function(){
    return view('overlay');
});

Route::get('/question-test','QuestionController@view');
Route::post('/get-eventdata','QuestionController@getEvent');
Route::post('/get-score-percentage','QuestionController@getScorePercentage');
Route::post('/fire-question','QuestionController@fireQuestion');
Route::post('/fire-scoreboard','QuestionController@fireScoreboard');
Route::post('/init-state','StreamController@initState');
Route::post('/quiz-state','StreamController@quizState');
Route::post('/quiz-state-observer','StreamController@quizStateObserver');
Route::post('/score-update','QuestionController@scoreUpdate');
Route::post('/score-update-observer','QuestionController@scoreUpdateObserver');
Route::post('/use-life','QuestionController@useLife');
Route::post('/get-transaction','CoinController@getTransaction');
Route::post('/get-winnerlist','StreamController@getWinnerList');

Route::post('/register-check','Auth\RegisterController@registerCheck');
Route::post('/register-check-edit','ProfileController@registerCheck');

Route::get('/debug1', 'DebugController@debug1');

Route::get('/debug-logout', 'DebugController@debug_logout');
Route::post('/reset-panel', 'DebugController@resetPanel');

Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/admin-event','EventController@index');
    Route::get('/admin-event-list','EventController@view_list');
    Route::post('/admin-event-create','EventController@create_event');
    Route::post('/create_questions', 'EventController@create_question');
    Route::post('/finish_questions', 'EventController@create_question');
    Route::post('/event_delete', 'EventController@delete_event');
    Route::get('/event-edit/{id}', 'EventController@view_event');
    Route::post('/event_save_details', 'EventController@event_save_details');
    Route::post('/event_save_question', 'EventController@event_save_question');
    Route::post('/event_delete_question', 'EventController@event_delete_question');
    Route::post('/event_create_question', 'EventController@event_create_question');
});

//debug-related routes

Route::get('/test', 'TestController@testView');
Route::get('/host', 'DebugController@viewHostPanel');
Route::get('/rehearsal', 'RehearsalController@view');
Route::post('/rehearsal-setquestion', 'RehearsalController@setQuestion');
Route::post('/get-question', 'DebugController@getQuestion');
Route::get('/registered-users', 'DebugController@getRegisteredUser');

//microsite routes

Route::get('/', 'WebsiteController@viewLanding');
Route::get('/website-partner', 'WebsiteController@viewPartner');
Route::get('/policy', 'AboutController@viewPolicy');

//mail test routes

Route::get('/mailtest', function(){
    return new App\Mail\PrelaunchMail('123456');
});
Route::get('/send-apology-mail', 'DebugController@apologyMail');
