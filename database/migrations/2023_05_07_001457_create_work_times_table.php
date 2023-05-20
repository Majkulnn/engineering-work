<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create("work_times", function (Blueprint $table): void {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->dateTime("start")->nullable();
            $table->dateTime("end")->nullable();
            $table->time("hour_count")->nullable();
            $table->string("position");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("work_times");
    }
};
