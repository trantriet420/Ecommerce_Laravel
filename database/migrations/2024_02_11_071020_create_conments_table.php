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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('comment')->nullable();
            $table->integer('id_blog')->nullable();
            $table->integer('id_user')->nullable();
            $table->string('avatar')->nullable();
            $table->string('name')->nullable();
            $table->unsignedInteger('level')->nullable()->default(1)->comment('1:cha 0:con');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
