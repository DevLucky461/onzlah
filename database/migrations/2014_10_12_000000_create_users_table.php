<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('gender')->nullable();
            $table->string('fullname')->nullable();
            $table->date('dateofbirth')->nullable();
            $table->text('picture')->nullable();
            //$table->string('occupation')->nullable();
            $table->string('current_states')->nullable();
            $table->string('current_city')->nullable();
            $table->string('phonenumber')->nullable();
            $table->string('email')->unique();
            $table->string('referral_code')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->integer('coins')->nullable();
            $table->integer('life')->nullable();
            $table->string('verify')->nullable();
            $table->integer('verificationcode');
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('rewards', function (Blueprint $table) {
            $table->id();
            $table->string('img_link')->nullable();
            $table->string('sponsor_icon_link')->nullable();
            $table->integer('cost_in_coins')->nullable();
            $table->string('reward_type')->nullable();
            $table->string('reward_name')->nullable();
            $table->dateTime('expiration_date')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('reward_counts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('reward_id')->nullable();
            $table->integer('count')->nullable();
            $table->dateTime('unlist_date')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('claims', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('reward_count_id')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->string('reward_code')->nullable();
            $table->string('status')->nullable()->default('valid');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('friends', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index();
            $table->bigInteger('friend_id')->unsigned()->index();
            $table->string('status')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('event_name')->nullable();
            $table->text('event_description')->nullable();
            $table->text('event_host_name')->nullable();
            $table->dateTime('event_start_date')->nullable();
            $table->dateTime('event_end_date')->nullable();
            $table->integer('event_coins_prize_pool')->nullable();
            $table->string('event_image_url')->nullable();
            $table->string('stream_key')->nullable();
            $table->string('question_state')->nullable();
            $table->string('fb_live_url')->nullable();
            $table->text('view_more_data')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('banner_name');
            $table->text('banner_description');
            $table->string('banner_image_url');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_type');
            $table->integer('transaction_value');
            $table->bigInteger('user_id')->unsigned()->index();
            $table->bigInteger('event_id')->unsigned()->index()->nullable();
            $table->bigInteger('reward_id')->unsigned()->index()->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('user_event', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index();
            $table->bigInteger('event_id')->unsigned()->index();
            $table->string('user_status')->nullable();
            $table->string('order')->nullable();
            $table->integer('used_life')->default('0');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('question_type');    //text or image
            $table->string('question')->nullable();
            $table->string('question_image')->nullable();
            $table->bigInteger('event_id')->unsigned()->index();
            $table->string('fired');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->string('answer')->nullable();
            $table->bigInteger('question_id')->unsigned()->index();
            $table->string('status')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('user_question', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('question_id')->unsigned()->index();
            $table->bigInteger('user_id')->unsigned()->index();
            $table->bigInteger('answer_id')->unsigned()->index();
            $table->string('status');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('stickers', function (Blueprint $table) {
            $table->id();
            $table->string('sticker_name');
            $table->string('src');
            $table->string('sticker_cost');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('sticker_states', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('event_id')->unsigned()->index();
            $table->bigInteger('sticker_id')->unsigned()->index();
            $table->integer('quantity')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('user_referrals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index();
            $table->bigInteger('referral_id')->unsigned()->index();
            //$table->string('status');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('life_transaction', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_type');
            $table->integer('transaction_value');
            $table->bigInteger('user_id')->unsigned()->index();
            $table->bigInteger('event_id')->unsigned()->index()->nullable();
            $table->bigInteger('reward_id')->unsigned()->index()->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('question_order', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('event_id')->unsigned()->index()->nullable();
            $table->bigInteger('question_id')->unsigned()->index()->nullable();
            $table->string('order');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_order');
        Schema::dropIfExists('users');
        Schema::dropIfExists('user_event');
        Schema::dropIfExists('user_question');
        Schema::dropIfExists('user_referrals');
        Schema::dropIfExists('rewards');
        Schema::dropIfExists('reward_counts');
        Schema::dropIfExists('vouchers');
        Schema::dropIfExists('friends');
        Schema::dropIfExists('events');
        Schema::dropIfExists('banners');
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('questions');
        Schema::dropIfExists('answers');
        Schema::dropIfExists('stickers');
        Schema::dropIfExists('sticker_states');
        Schema::dropIfExists('life_transaction');
        Schema::dropIfExists('claims');

        
    }
}
