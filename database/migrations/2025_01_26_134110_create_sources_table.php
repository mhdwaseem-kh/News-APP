<?php

use App\Constants\Models\CategoryColumns;
use App\Constants\Models\SourceColumns;
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
        Schema::create(SourceColumns::TABLE, function (Blueprint $table) {
            $table->id();
            $table->string(SourceColumns::EXTERNAL_ID)->unique();
            $table->unsignedBigInteger(SourceColumns::CATEGORY_ID);
            $table->string(SourceColumns::NAME);
            $table->timestamps();

            $table->foreign(SourceColumns::CATEGORY_ID)->references(CategoryColumns::ID)
                ->on(CategoryColumns::TABLE);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(SourceColumns::TABLE);
    }
};
