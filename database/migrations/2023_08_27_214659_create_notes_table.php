<?php

use App\Models\User;
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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable();
            $table->text('body');
            $table->string('image')->nullable();
            $table->foreignIdFor(User::class)->constrained()->onUpdate('cascade')
            ->onDelete('cascade');
            $table->boolean('is_active')->nullable();
            $table->boolean('is_admin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
