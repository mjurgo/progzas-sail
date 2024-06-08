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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('grades', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Subject::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
        Schema::table('grades', function (Blueprint $table) {
            $table->dropForeign('grades_teacher_id_foreign');
            $table->dropColumn('teacher_id');
        });
    }
};
