<?php

use App\Constants\Models\AuthorColumns;
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
        Schema::create(AuthorColumns::TABLE, function (Blueprint $table) {
            $table->id();
            $table->string(AuthorColumns::NAME)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(AuthorColumns::TABLE);
    }
};
