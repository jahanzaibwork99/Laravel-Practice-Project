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
        Schema::table('employees', function (Blueprint $table) {

            $table->dropColumn('department');
            $table->foreignId('department_id')
                  ->constrained('departments')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {

            $table->dropForeign(['department_id']);
            $table->dropColumn('department_id');
            $table->string('department');

        });
    }
};