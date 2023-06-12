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
        Schema::create('asset_loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_id')->constrained(
                table:'loans', indexName:'fk_asset_loan_to_loans'
            )->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreignId('asset_id')->constrained(
                table:'assets', indexName:'fk_asset_loan_to_assets'
            )->cascadeOnDelete()->cascadeOnUpdate();

            $table->integer('unit_borrowed');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_loan');
        Schema::table('asset_loan', function (Blueprint $table) {
            $table->dropForeign('fk_asset_loan_to_loans');
            $table->dropForeign('fk_asset_loan_to_assets');
        });
    }
};
