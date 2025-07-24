<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('form_fields', function (Blueprint $table) {
            $table->id();
            $table->string('field_name');
            $table->string('field_label');
            $table->enum('field_type', ['text', 'email', 'tel', 'textarea', 'file', 'select', 'checkbox', 'radio', 'date', 'number']);
            $table->json('field_options')->nullable();
            $table->json('validation_rules')->nullable();
            $table->boolean('is_system_field')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('form_fields');
    }
};
