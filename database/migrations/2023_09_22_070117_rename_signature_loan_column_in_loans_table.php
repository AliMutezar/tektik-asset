<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('loans', function (Blueprint $table) {
            if (Schema::hasColumn('loans', 'signature_loan')) {
                $table->dropColumn('signature_loan');
                $table->string('signature_borrower')->after('loan_user_id')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('loans', function (Blueprint $table) {
            if (Schema::hasColumn('loans', 'signature_borrower')) {
                $table->dropColumn('signature_borrower');
                $table->string('signature_loan')->after('loan_user_id')->nullable();
            }
        });
    }
};
