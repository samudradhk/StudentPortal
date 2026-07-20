<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PhpParser\Node\Expr\FuncCall;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('scores', function (Blueprint $table) {
            $table->integer('attendance')->default(0);
            $table->integer('assignment')->default(0);
            $table->integer('mid_exam')->default(0);
            $table->integer('final_exam')->default(0);
        });
        Schema::table('students', function(Blueprint $table){
            $table->boolean('prediction')->nullable(true)->default(null);
        });
    }

    public function down(): void
    {
        Schema::table('scores', function (Blueprint $table) {
            $table->dropColumn('attendance');
            $table->dropColumn('assignment');
            $table->dropColumn('mid_exam');
            $table->dropColumn('final_exam');
        });
        Schema::table('students', function(Blueprint $table){
            $table->dropColumn('prediction');
        });
    }
};
