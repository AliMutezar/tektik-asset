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
        Schema::table('asset_returns', function (Blueprint $table) {
            $table->foreignId('loan_id')->after('return_code')->constrained(
                table:'loans', indexName:'fk_asset_returns_to_loans'
            )->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreignId('admin_user_id')->after('signature_returner')->constrained(
                table:'users', indexName:'fk_asset_returns_to_users'
            )->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('asset_returns', function (Blueprint $table) {
            $table->dropForeign('fk_asset_returns_to_loans');
            $table->dropForeign('fk_asset_returns_to_users');
        });
    }
};
