<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('coupons', function ($table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('short_url', 128)->nullable();
            $table->string('title')->nullable();
            $table->string('website')->nullable();
            $table->string('phone', 24)->nullable();
            $table->text('details')->nullable();
            $table->mediumText('content')->nullable();
            $table->string('address')->nullable();
            $table->string('street')->nullable();
            $table->string('street_number', 12)->nullable();
            $table->string('postal_code', 12)->nullable();
            $table->string('city', 128)->nullable();
            $table->string('state', 64)->nullable();
            $table->string('country', 5)->nullable();
            $table->decimal('lat', 10, 8)->nullable();
            $table->decimal('lng', 11, 8)->nullable();
            $table->timestamp('valid_from_date')->nullable();
            $table->date('expiration_date')->nullable();
            $table->dateTime('expiration_date_time')->nullable();
            $table->string('redeem_code', 250)->nullable();
            $table->integer('number_of_times_redeemed')->default(0);
            $table->timestamp('last_redemption')->nullable();
            $table->integer('total_amount_of_coupons')->default(0);
            $table->integer('amount_of_coupons_per_user')->nullable();
            $table->integer('can_be_redeemed_more_than_once')->nullable();

            $table->string('language', 5)->default('en');
            $table->string('timezone', 32)->default('UTC');

            $table->json('fields')->nullable();
            $table->json('meta')->nullable();
            $table->json('settings')->nullable();
            $table->boolean('active')->default(true);

            // Image
            $table->string('image_file_name')->nullable();
            $table->integer('image_file_size')->nullable();
            $table->string('image_content_type')->nullable();
            $table->timestamp('image_updated_at')->nullable();

            $table->timestamps();
        });

        Schema::create('coupon_leads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('coupon_id')->unsigned();
            $table->foreign('coupon_id')->references('id')->on('coupons')->onDelete('cascade');

            $table->json('field_names')->nullable();
            $table->json('field_values')->nullable();

            $table->json('meta')->nullable();
            $table->dateTime('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupon_leads');
        Schema::dropIfExists('coupons');
    }
};
