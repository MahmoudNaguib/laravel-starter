<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->index()->nullable();
            $table->tinyText('title')->nullable();
            $table->mediumText('content')->nullable();
            $table->boolean('send_email')->nullable()->default(0)->index();
            $table->boolean('send_push')->nullable()->default(0)->index();
            $table->string('entity_type')->nullable()->index();
            $table->bigInteger('entity_id')->index()->nullable();
            $table->timestamp('seen_at')->nullable()->index();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->index();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('deleted_at')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('notifications');
    }

}
