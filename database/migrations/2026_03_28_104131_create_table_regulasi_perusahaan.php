<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('regulasi_perusahaan', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 100)->index();
            $table->text('deskripsi')->nullable();
            $table->string('nomor', 50)->unique();
            $table->enum('tipe', ['peraturan', 'kebijakan'])->index();
            $table->enum('status', ['Y', 'N'])->index();
            $table->date('tanggal_terbit')->nullable();
            $table->date('tanggal_berlaku')->nullable()->index();
            $table->date('tanggal_berakhir')->nullable();
            $table->bigInteger('created_by')->default('20');
            $table->bigInteger('updated_by')->nullable()->default('20');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('regulasi_perusahaan');
    }
};
