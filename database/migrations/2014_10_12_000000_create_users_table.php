<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('name');
            $table->string('email')->unique();
            $table->string('api_token', 80)
            ->unique()
            ->nullable()
            ->default(null);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            // $table->increments('id');
            // $table->string('name');
            // $table->string('email')->unique();
            // $table->string('password');
            // $table->string('type')->default('user');
            // $table->enum('user_status', ['ACTIVATED', 'DEACTIVATED', 'PENDING'])->default('DEACTIVATED');
            // $table->enum('dvd_access_status', ['NONE', 'AUDIO_DVD', 'VIDEO_DVD', 'ALL'])->default('NONE');
            // $table->string('audio_dvd_permission')->nullable();
            // $table->string('video_dvd_permission')->nullable();
            // $table->enum('song_access_status', ['NO',  'YES'])->default('NO');
            // $table->enum('is_email_verified', ['NO', 'YES'])->default('NO');
            // $table->string('api_token', 80)
            // ->unique()
            // ->nullable()
            // ->default(null);
            // $table->rememberToken();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
