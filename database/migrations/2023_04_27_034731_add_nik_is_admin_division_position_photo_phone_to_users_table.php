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
        Schema::table('users', function (Blueprint $table) {
            $table->string('nik')->after('id')->nullable();
            $table->foreignId('division_id')->after('nik')->nullable()->index('fk_users_to_divisions');
            $table->string('role')->after('division_id')->nullable();
            $table->string('position')->after('name')->nullable();
            $table->string('image')->after('password')->nullable();
            $table->string('phone')->after('email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nik', 'role', 'position', 'image', 'phone']);
        });
    }
};
