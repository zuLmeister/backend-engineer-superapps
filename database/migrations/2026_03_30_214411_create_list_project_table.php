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
        
        Schema::create('list_project', function (Blueprint $table) {
            $table->id();
            $table->string('pjo_name', 100)->index();
            $table->string('phone', 15);
            $table->string('location', 100);
            $table->string('position', 100);
            $table->enum('status', ['pending', 'active', 'completed', 'cancelled'])->index();
            $table->date('start_date')->nullable()->index();
            $table->date('end_date')->nullable()->index();
            $table->text('notes')->nullable();
            $table->string('project_type', 50)->nullable()->index();
            $table->softDeletes();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_project');
    }
};
