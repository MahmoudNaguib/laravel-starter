<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('configs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('field')->nullable();
            $table->mediumText('value')->nullable();
            $table->bigInteger('created_by')->nullable()->index();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('deleted_at')->nullable()->index();
        });
    }

    /**
     *
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('configs');
    }
}
