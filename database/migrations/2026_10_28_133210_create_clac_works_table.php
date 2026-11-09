<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->date('date_limite');
            $table->integer('age_min');
            $table->integer('age_max');
            $table->string('pieces_a_fournir');
            $table->string('image_url');
            $table->string('lieu_depot');
            $table->string('societe');
            $table->string('contact');
            $table->foreignIdFor(User::class)
            ->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clac_works');
    }
};
