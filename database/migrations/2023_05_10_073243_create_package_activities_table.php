<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_activities', function (Blueprint $table) {
            $table->id();
            $table->text('activities')->nullable();
            $table->text('trip_grade')->nullable();
            $table->text('trip_type')->nullable();
            $table->text('trip_mode')->nullable();
            $table->text('trip_duration')->nullable();
            $table->text('accomodation')->nullable();
            $table->text('best_season')->nullable();
            $table->text('transportation')->nullable();
            $table->text('group_size')->nullable();
            $table->bigInteger('package_id')->nullable();
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
        Schema::dropIfExists('package_activities');
    }
}
