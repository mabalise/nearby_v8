<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned()->nullable();
            $table->foreign('parent_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('role', 24)->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('token')->nullable();
            $table->integer('pages_limit')->nullable();
            $table->integer('deals_limit')->nullable();
            $table->integer('coupons_limit')->nullable();
            $table->integer('rewards_limit')->nullable();
            $table->integer('properties_limit')->nullable();
            $table->integer('business_cards_limit')->nullable();
            $table->integer('videos_limit')->nullable();
            $table->char('country_code', 2)->nullable();
            $table->char('currency_code', 3)->default('USD');
            $table->string('locale', 5)->default('en');
            $table->string('timezone', 32)->default('UTC');
            $table->boolean('active')->default(true);
            $table->boolean('confirmed')->default(false);
            $table->string('confirmation_code')->nullable();
            $table->string('avatar_file_name')->nullable();
            $table->integer('avatar_file_size')->nullable();
            $table->string('avatar_content_type')->nullable();
            $table->timestamp('avatar_updated_at')->nullable();
            $table->integer('logins')->default(0)->unsigned();
            $table->dateTime('last_login')->nullable();
            $table->ipAddress('last_ip')->nullable();
            $table->json('settings')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
