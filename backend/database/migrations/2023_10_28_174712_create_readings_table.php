<?php

use App\Domains\Word\Models\Reading;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    //
    public function up(): void
    {
        Schema::create(app(Reading::class)->getTable(), function (Blueprint $table) {
            $table->id();
            $table->string('word_id')->index();
            $table->string('reading');
            $table->string('kanji')->nullable();
            $table->datetimes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(app(Reading::class)->getTable());
    }
};
