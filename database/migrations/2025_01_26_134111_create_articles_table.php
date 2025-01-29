<?php

use App\Constants\ExternalPlatforms\ExternalPlatforms;
use App\Constants\Models\ArticleColumns;
use App\Constants\Models\AuthorColumns;
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
        Schema::create(ArticleColumns::TABLE, function (Blueprint $table) {
            $table->id();
            $table->string(ArticleColumns::EXTERNAL_ID)->nullable();
            $table->unsignedBigInteger(ArticleColumns::SOURCE_ID);
            $table->unsignedBigInteger(ArticleColumns::AUTHOR_ID);
            $table->unsignedBigInteger(ArticleColumns::CATEGORY_ID);
            $table->enum(ArticleColumns::EXTERNAL_PLATFORM, ExternalPlatforms::SET);
            $table->string(ArticleColumns::TITLE);
            $table->text(ArticleColumns::CONTENT)->nullable();
            $table->string(ArticleColumns::IMAGE)->nullable();
            $table->timestamp(ArticleColumns::PUBLISHED_AT)->nullable();
            $table->string(ArticleColumns::EXTERNAL_URL)->nullable();
            $table->timestamps();

            $table->foreign(ArticleColumns::SOURCE_ID)
                ->references(SourceColumns::ID)->on(SourceColumns::TABLE);
            $table->foreign(ArticleColumns::AUTHOR_ID)
                ->references(AuthorColumns::ID)->on(AuthorColumns::TABLE);
            $table->foreign(ArticleColumns::CATEGORY_ID)
                ->references(CategoryColumns::ID)->on(CategoryColumns::TABLE);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(ArticleColumns::TABLE);
    }
};
