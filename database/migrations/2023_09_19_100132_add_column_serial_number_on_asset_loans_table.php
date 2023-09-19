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
        Schema::table('asset_loans', function (Blueprint $table) {
            if(!Schema::hasColumn('asset_loans', 'serial_number')){
                $table->string('serial_number')->after('unit_borrowed')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('asset_loans', function (Blueprint $table) {
            if(Schema::hasColumn('asset_loans', 'serial_number')){
               $table->dropColumn('serial_number');
            }
        });
    }
};
