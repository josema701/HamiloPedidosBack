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
        // telefono, otp, tipo, verificado
        Schema::table('users', function (Blueprint $table) {
            $table->string('telefono')->nullable()->after('email');
            $table->string('otp')->nullable()->after('telefono');
            $table->string('tipo')->default('Administrador')->after('otp'); // Administrador, Cliente, Negocio
            $table->boolean('verificado')->default(true)->after('tipo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('telefono');
            $table->dropColumn('otp');
            $table->dropColumn('tipo');
            $table->dropColumn('verificado');
        });
    }
};
