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
        Schema::table('items', function (Blueprint $table) {
            //カラム追加
            $table->unsignedTinyInteger('genre')->nullable();
            $table->date('release_date')->nullable();
            $table->Integer('price')->nullable();
            $table->string('author', 100)->nullable();
            $table->string('publisher', 100)->nullable();
            $table->Integer('stock')->nullable();
            $table->string('image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            //カラム削除
            $table->dropColumn('genre');
            $table->dropColumn('release_date');
            $table->dropColumn('price');
            $table->dropColumn('author');
            $table->dropColumn('publisher');
            $table->dropColumn('stock');
            $table->dropColumn('image');
        });
    }
};
