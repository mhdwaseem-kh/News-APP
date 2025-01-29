<?php

use App\Constants\Models\CategoryColumns;
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
        Schema::create(CategoryColumns::TABLE, function (Blueprint $table) {
            $table->id();
            $table->string(CategoryColumns::EXTERNAL_ID)->unique();
            $table->string(CategoryColumns::NAME)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(CategoryColumns::TABLE);
    }
};
