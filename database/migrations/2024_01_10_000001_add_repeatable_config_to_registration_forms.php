<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('registration_forms', function (Blueprint $table) {
            $table->json('repeatable_config')->nullable()->after('registration_end');
        });
    }

    public function down()
    {
        Schema::table('registration_forms', function (Blueprint $table) {
            $table->dropColumn('repeatable_config');
        });
    }
};
