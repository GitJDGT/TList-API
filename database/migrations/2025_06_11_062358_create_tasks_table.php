<?php

use App\Enums\TaskStatusEnum;
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
        // The image column uses the TEXT data type because all we really need
        // is the path of the image, in this cases the images will be stored locally.
        // this also aplies to the task list image column.

        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_list_id')->constrained()->onDelete('cascade');
            $table->text('description');
            $table->text('image')->nullable();
            $table->string('status')->default(TaskStatusEnum::PENDING->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
