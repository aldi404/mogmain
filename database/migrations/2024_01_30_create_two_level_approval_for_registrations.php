<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('event_registrations', function (Blueprint $table) {
            // Remove old approval column if exists
            if (Schema::hasColumn('event_registrations', 'approved')) {
                $table->dropColumn('approved');
            }

            // Add new approval columns
            $table->boolean('data_approved')->default(false)->after('status');
            $table->boolean('payment_approved')->default(false)->after('data_approved');
            $table->string('invoice_number')->nullable()->after('payment_approved');
            $table->string('invoice_path')->nullable()->after('invoice_number');
            $table->timestamp('data_approved_at')->nullable()->after('invoice_path');
            $table->timestamp('payment_approved_at')->nullable()->after('data_approved_at');
            $table->unsignedBigInteger('data_approved_by')->nullable()->after('payment_approved_at');
            $table->unsignedBigInteger('payment_approved_by')->nullable()->after('data_approved_by');

            // Foreign keys
            $table->foreign('data_approved_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('payment_approved_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('event_registrations', function (Blueprint $table) {
            $table->dropForeign(['data_approved_by']);
            $table->dropForeign(['payment_approved_by']);
            $table->dropColumn([
                'data_approved',
                'payment_approved',
                'invoice_number',
                'invoice_path',
                'data_approved_at',
                'payment_approved_at',
                'data_approved_by',
                'payment_approved_by'
            ]);

            // Add back old column
            $table->boolean('approved')->default(false);
        });
    }
};
