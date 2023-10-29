<?php

use App\Domains\Word\Models\Sense;
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
        Schema::create(app(Sense::class)->getTable(), function (Blueprint $table) {
            $table->bigInteger('word_id')->index()->unique();
            $table->json('english_definitions');
            $table->json('part_of_speech');
            $table->json('links');
            $table->json('text');
            $table->json('url');
            $table->json('tags');
            $table->json('restrictions');
            $table->json('see_also');
            $table->json('antonyms');
            $table->json('source');
            $table->json('info');
            $table->json('sentences');
            $table->datetimes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(app(Sense::class)->getTable());
    }
};
