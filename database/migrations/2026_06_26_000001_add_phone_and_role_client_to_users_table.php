<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->unique()->nullable()->after('email');
            // Add 'client' to the existing role enum and change default
            // We use DB::statement because enum changes require raw SQL on most drivers
            \Illuminate\Support\Facades\DB::statement(
                "ALTER TABLE users MODIFY COLUMN role ENUM('admin','superadmin','client') NOT NULL DEFAULT 'client'"
            );
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone');
            \Illuminate\Support\Facades\DB::statement(
                "ALTER TABLE users MODIFY COLUMN role ENUM('admin','superadmin') NOT NULL DEFAULT 'admin'"
            );
        });
    }
};
