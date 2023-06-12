<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->foreignId('loan_user_id')->after('loan_code')->constrained(
                table:'users', indexName:'fk_loans_to_user_loan'
            )->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreignId('admin_user_id')->after('signature_loan')->constrained(
                table:'users', indexName:'fk_loans_to_user_admin'
            )->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->dropForeign('fk_loans_to_user_loan');
            $table->dropForeign('fk_loans_to_user_admin');
        });
    }
};
