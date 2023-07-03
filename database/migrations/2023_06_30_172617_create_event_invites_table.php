<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventInvitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_invites', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id')->nullable();
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->unsignedBigInteger('org_id')->nullable();
            $table->foreign('org_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('email');
            $table->enum('status',['invite','reject']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('event_invites');
        Schema::table('event_invites', function (Blueprint $table) {
            $table->dropColumn('event_id');
            $table->dropColumn('org_id');
        });
    }
}
