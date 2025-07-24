<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('registration_form_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registration_form_id')->constrained('registration_forms')->onDelete('cascade');
            $table->foreignId('form_field_id')->constrained('form_fields');
            $table->boolean('is_required')->default(false);
            $table->integer('field_order');
            $table->string('custom_label')->nullable();
            $table->json('custom_validation')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('registration_form_fields');
    }
};
