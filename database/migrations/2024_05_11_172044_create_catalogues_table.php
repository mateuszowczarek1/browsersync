<?php

use App\Models\Bookmark;
use App\Models\Catalogue;
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
        Schema::create('catalogues', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->boolean('is_published')->default(false);
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('bookmark_catalogue', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Bookmark::class, 'bookmark_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Catalogue::class, 'catalogue_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalogues');
    }
};
