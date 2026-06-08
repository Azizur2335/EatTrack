<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
            $table->enum('category', ['bug', 'saran', 'keluhan', 'pertanyaan']);
            $table->string('title');
            $table->text('message');
            $table->string('screenshot')->nullable();
            $table->foreignId('reservation_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('restaurant_id')->nullable()->constrained()->onDelete('set null');
            $table->enum('status', ['belum_dibaca', 'dibaca', 'ditindaklanjuti', 'ditutup'])->default('belum_dibaca');
            $table->text('admin_note')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};