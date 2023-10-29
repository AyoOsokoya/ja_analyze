<?php
declare(strict_types = 1);

use App\Domains\Word\Models\Word;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(app(Word::class)->getTable(), function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary()->index()->unique();
            $table->string('slug')->unique();
            $table->datetimes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(app(Word::class)->getTable());
    }
};
