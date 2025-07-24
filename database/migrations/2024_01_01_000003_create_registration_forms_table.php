<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('registration_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->string('form_title');
            $table->text('form_description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->datetime('registration_start');
            $table->datetime('registration_end');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('registration_forms');
    }
};
