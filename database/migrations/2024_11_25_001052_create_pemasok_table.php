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
    Schema::create('pemasok', function (Blueprint $table) {
        $table->id();
        $table->string('nama_pemasok', 255);
        $table->text('alamat');
        $table->string('kontak', 255);
        $table->unsignedBigInteger('kontrak_id');
        $table->integer('rating_pemasok');
        $table->timestamps();

        $table->foreign('kontrak_id')->references('id')->on('kontrak')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemasok');
    }
};
