<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create("holidays", function (Blueprint $table): void {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->date("start_date");
            $table->date("end_date");
            $table->string("type");
            $table->integer("days_count");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("holidays");
    }
};
