<?php

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
        Schema::create('proyects', function (Blueprint $table) {
            $table->id();
            $table->string('PRO_NAME', 200)->nullable(false);
            $table->longText('PRO_DESC')->nullable(false);
            $table->longText('PRO_IMAGE')->nullable();
            $table->string('PRO_IMAGExt',15)->nullable();
            $table->char('PRO_STATUS', 1)->nullable();
            $table->timestamps();
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyects');
    }
};
