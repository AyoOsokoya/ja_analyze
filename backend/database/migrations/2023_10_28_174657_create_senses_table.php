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
            $table->id();
            $table->bigInteger('word_id')->index();
            $table->json('english_definitions');
            $table->json('parts_of_speech')->nullable(); // Assume the data is dirty
            $table->json('links')->nullable();
            $table->json('tags')->nullable();
            $table->json('restrictions')->nullable();
            $table->json('see_also')->nullable();
            $table->json('antonyms')->nullable();
            $table->json('source')->nullable();
            $table->json('info')->nullable();
            $table->json('sentences')->nullable();
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
