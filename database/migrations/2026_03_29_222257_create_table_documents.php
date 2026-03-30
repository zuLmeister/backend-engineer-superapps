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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id_db_1')->index()->default('20');
            $table
                ->enum('document_type', ['award', 'certificate'])
                ->index();
            $table->string('document_name', 100);
            $table->string('document_number', 100)->nullable();
            $table->text('document_path');
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
        Schema::dropIfExists('documents');
    }
};
