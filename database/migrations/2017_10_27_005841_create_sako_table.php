<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSakoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

      Schema::create('profiles', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('user_id')->unsigned();
        $table->string('place_of_birth')->nullable();
        $table->date('date_of_birth')->nullable();
        $table->enum('sex', ['Male', 'Female'])->default('Male');
        $table->enum('religion', ['Islam', 'Christian', 'Katholik', 'Buddha', 'Hindu', 'Other'])->default('Other');
        $table->enum('status_marriage', ['Single', 'Married', 'Divorced', 'Death Divorce'])->default('Single');
        $table->enum('citizen', ['WNI','WNA'])->default('WNI');
        $table->text('address')->nullable();
        $table->string('telephone')->nullable();
        $table->string('univercity')->nullable();
        $table->string('grade')->nullable();
        $table->float('ipk')->nullable();
        $table->string('graduation')->nullable();

        $table->foreign('user_id')->references('id')->on('users')
              ->onUpdate('cascade')->onDelete('cascade');

      });

      Schema::create('articles', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id')->unsigned();
          $table->string('title');
          $table->string('slug');
          $table->enum('post_status',['Draft', 'Publish'])->default('Draft');
          $table->string('images')->default('/photos/no-image.jpg');
          $table->text('description');
          $table->timestamps();

          $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
      });

      Schema::create('tours', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('user_id')->unsigned()->nullable();
        $table->string('title');
        $table->string('slug')->unique();
        $table->enum('category',['Domestik','Internasional'])->default('Domestik');
        $table->string('images')->default('/photos/no-image.jpg');
        $table->enum('post_status', ['Draft', 'Publish'])->default('Draft');
        $table->string('duration');
        $table->date('start_period');
        $table->date('end_period');
        $table->integer('price');
        $table->longtext('itinerary');
        $table->longtext('terms_conditions');
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')
              ->onUpdate('cascade')->onDelete('set null');
      });

      Schema::create('umrohs', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('user_id')->unsigned()->nullable();
        $table->string('title');
        $table->string('slug')->unique();
        $table->enum('category',['Ekonomis','Gold','VIP'])->default('Ekonomis');
        $table->string('images')->nullable()->default('/photos/no-image.jpg');
        $table->enum('post_status', ['Draft', 'Publish'])->default('Draft');
        $table->string('duration');
        $table->date('start_period');
        $table->date('end_period');
        $table->integer('price');
        $table->longtext('itinerary');
        $table->longtext('terms_conditions');
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')
        ->onUpdate('cascade')->onDelete('set null');
      });

      Schema::create('booking_tours', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('package_id')->unsigned()->nullable();
        $table->string('code_booking')->unique();
        $table->string('name');
        $table->string('email');
        $table->string('telephone');
        $table->integer('price');
        $table->integer('participant');
        $table->bigInteger('total');
        $table->date('departure_date');
        $table->text('note')->nullable();
        $table->enum('status', ['Approved', 'Pending', 'Rejected'])->default('Pending');
        $table->text('reason_rejection')->nullable();
        $table->timestamps();

        $table->foreign('package_id')->references('id')->on('tours')
              ->onUpdate('cascade')->onDelete('set null');
      });

      Schema::create('booking_umrohs', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('package_id')->unsigned()->nullable();
        $table->string('code_booking')->unique();
        $table->string('name');
        $table->string('email');
        $table->string('telephone');
        $table->integer('price');
        $table->integer('participant');
        $table->bigInteger('total');
        $table->enum('status', ['Approved', 'Pending', 'Rejected'])->default('Pending');
        $table->text('reason_rejection')->nullable();
        $table->timestamps();

        $table->foreign('package_id')->references('id')->on('umrohs')
              ->onUpdate('cascade')->onDelete('set null');
      });

      Schema::create('request_tours', function (Blueprint $table) {
        $table->increments('id');
        $table->string('code_booking')->unique();
        $table->string('name');
        $table->string('email');
        $table->string('telephone');
        $table->string('location');
        $table->string('duration');
        $table->longtext('note')->nullable();
        $table->enum('status', ['Approved', 'Pending', 'Rejected'])->default('Pending');
        $table->text('reason_rejection')->nullable();
        $table->timestamps();
      });

      Schema::create('slideshows', function (Blueprint $table) {
        $table->increments('id');
        $table->enum('slug',['tiket','hotel','tour','umroh'])->default('tour');
        $table->string('images');
        $table->enum('post_status',['Draft','Publish'])->default('Publish');
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
        Schema::drop('profiles');
        Schema::drop('articles');
        Schema::drop('booking_tours');
        Schema::drop('booking_umrohs');
        Schema::drop('tours');
        Schema::drop('umrohs');
        Schema::drop('request_tours');
        Schema::drop('slideshows');
    }
}
