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
        Schema::table('assets', function (Blueprint $table) {
            if (!Schema::hasColumn('assets', 'category_asset_id')) {
                $table->foreignId('category_asset_id')->after('id')->nullable()
                    ->constrained(
                        table: 'category_asset', indexName: 'fk_assets_to_category_asset'
                    )->cascadeOnDelete()->cascadeOnUpdate();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->dropForeign('fk_assets_to_category_asset');
            $table->dropColumn('category_asset_id');
        });
    }
};
