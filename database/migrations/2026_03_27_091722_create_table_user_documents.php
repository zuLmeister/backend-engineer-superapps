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
        Schema::create('user_documents', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id_db_1')->index()->default('20');
            $table
                ->enum('file_type', ['mcu', 'medpass', 'sertif_training', 'sertif_bnsp'])
                ->index();
            $table->string('file_name', 100);
            $table->string('file_number', 100)->nullable();
            $table->text('file_path');
            $table->date('issued_date')->index();
            $table->date('expired_date')->index();
            $table->text('notes')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_documents');
    }
};
