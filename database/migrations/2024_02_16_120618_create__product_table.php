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
        Schema::create('Product', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user')->nullable();
            $table->string('name')->nullable();
            $table->decimal('price',10,2)->nullable();
            $table->integer('id_category')->nullable();
            $table->integer('id_brand')->nullable();
            $table->unsignedInteger('status')->nullable()->default(1)->comment='0:new 1:sale';
            $table->string('sale')->nullable();
            $table->string('company')->nullable();
            $table->string('hinhanh')->nullable();
            $table->string('detail')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Product');
    }
};
