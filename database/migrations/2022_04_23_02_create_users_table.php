<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('type', ['admin', 'guest'])->nullable()->default('guest')->index();
            $table->string('name',190)->nullable()->index();
            $table->string('email',190)->nullable()->index();
            $table->string('mobile',190)->nullable()->index();
            $table->string('password')->nullable();
            $table->string('token')->nullable(); // API
            $table->string('remember_token')->nullable();
            $table->string('confirm_token')->nullable();
            $table->string('password_token')->nullable();
            $table->boolean('confirmed')->nullable()->default(0)->index();
            $table->boolean('is_active')->nullable()->default(1)->index();
            $table->timestamp('last_logged_in_at')->nullable();
            $table->string('last_ip')->nullable();
            $table->string('image')->nullable();
            $table->timestamp('created_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('deleted_at')->nullable()->index();
        });
        if (app()->environment() != 'testing') {
            Schema::table('users', function (Blueprint $table) {
                \DB::statement('ALTER TABLE users ADD FULLTEXT search(`name`,`email`,`mobile`)');
            });
        }
    }

    /**
     *
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('users');
    }
}
