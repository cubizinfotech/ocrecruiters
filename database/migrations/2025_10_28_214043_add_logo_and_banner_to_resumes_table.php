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
        Schema::table('resumes', function (Blueprint $table) {
            $table->string('logo_path')->nullable()->after('file_path');
            $table->string('logo_original_name')->nullable()->after('logo_path');
            $table->string('banner_path')->nullable()->after('logo_original_name');
            $table->string('banner_original_name')->nullable()->after('banner_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('resumes', function (Blueprint $table) {
            $table->dropColumn([
                'logo_path',
                'logo_original_name',
                'banner_path',
                'banner_original_name'
            ]);
        });
    }
};
