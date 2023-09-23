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
            $table->string('firstname')->after('name')->nullable();
            $table->string('lastname')->after('firstname')->nullable();
            $table->string('companyname')->after('lastname')->nullable();
            $table->string('address')->after('companyname')->nullable();
            $table->string('phone')->after('address')->nullable();
            $table->date('birthdate')->after('phone')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('firstname');
            $table->dropColumn('lastname');
            $table->dropColumn('companyname');
            $table->dropColumn('address');
            $table->dropColumn('phone');
            $table->dropColumn('birthdate');
        });
    }
};
