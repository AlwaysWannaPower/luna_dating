<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar')->nullable()->after('email');
            $table->date('birth_date')->nullable()->after('password');
            $table->enum('gender', ['male', 'female'])->nullable()->after('birth_date');
            $table->enum('looking_for', ['male', 'female', 'both'])->nullable()->after('gender');
            $table->string('city')->nullable()->after('looking_for');
            $table->text('bio')->nullable()->after('city');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['avatar', 'birth_date', 'gender', 'looking_for', 'city', 'bio']);
        });
    }
};
