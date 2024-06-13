<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/getUser', 'DebugController@debug_unity');

Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');
Route::post('logout', 'AuthController@logout');
Route::post('refresh', 'AuthController@refresh');
Route::post('verification', 'AuthController@verification');

Route::get('leaderboadfriend/{id}', 'AuthController@leaderboadfriend');
Route::get('leaderboadall/{id}', 'AuthController@leaderboadall');

Route::post('getCurrentUser', 'AuthController@getCurrentUser');
Route::post('becomepartner', 'AuthController@becomepartner');
Route::post('getNotiSettingsData', 'AuthController@getNotiSettingsData');
Route::post('postNotiSettingsData', 'AuthController@postNotiSettingsData');
Route::post('viewReferral', 'AuthController@viewReferral');
Route::post('editPassword', 'AuthController@editPassword');
Route::post('editUserData', 'AuthController@editUserData');
Route::post('editUserData2', 'AuthController@editUserData2');

Route::get('viewMainPage/{id}', 'AuthController@viewMainPage');
Route::get('viewRedeemPage/{id}', 'AuthController@viewRedeemPage'); //redeempage initalurl

Route::post('reward-filter-button', 'AuthController@rewardFilterButton');
Route::post('reward-filter-input', 'AuthController@rewardFilterInput');
Route::get('viewRedeemPageDetails/{user_id}/{redeem_id}', 'AuthController@viewRedeemPageDetails');
Route::post('/redeem-add', 'AuthController@addVoucher');
Route::get('/myredeem/{id}', 'AuthController@viewVoucher');
Route::get('/myredeem-details/{redeem_id}/{claim_id}', 'AuthController@viewMyRedeemDetails');
Route::post('/use-reward', 'AuthController@useReward');

// My Friends - Start
Route::get('/viewMyFriendsList/{id}', 'AuthController@viewMyFriendsList');
Route::post('/deleteFriend', 'AuthController@deleteFriend');
Route::get('/viewMyFriendsFriendRequest/{id}', 'AuthController@viewMyFriendsFriendRequest');
Route::post('/acceptFriend', 'AuthController@acceptFriend');
Route::get('/viewMyFriendsAddFriend/{id}', 'AuthController@viewMyFriendsAddFriend');
Route::post('/searchFriend', 'AuthController@searchFriend');
Route::post('/addFriend', 'AuthController@addFriend');
// My Friends - End

Route::get('qrmobile/{id}/', 'AuthController@qrmobileview');
Route::get('/qr-add-friend/{friend_id}','AuthController@mobile_add_friend' );

Route::get('/mycommunity/{id}', 'AuthController@mobile_community');
Route::post('/create_feedback_mobile', 'AuthController@create_community');

Route::get('/notifications/{id}', 'AuthController@notifications');
Route::post('update-notification_status', 'AuthController@notification_update');

Route::post('/notification_count', 'AuthController@notification_count');

//ashari api
//----------------------------------------------------------------------------------------------// 

Route::match(['GET', 'POST'],'live-init', 'Mobile\LiveController@liveInit');
Route::match(['GET', 'POST'],'sticker-update', 'Mobile\LiveController@stickerUpdate');
Route::match(['GET', 'POST'],'send-message', 'Mobile\LiveController@sendMessage');
Route::match(['GET', 'POST'],'get-quiz-state', 'Mobile\LiveController@quizState');
Route::match(['GET', 'POST'],'score-update', 'Mobile\LiveController@scoreUpdate');
