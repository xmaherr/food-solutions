<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Step 1: Add new *_ar and *_en columns (nullable)
     * Step 2: Copy existing data into both columns
     * Step 3: Make required columns not nullable
     * Step 4: Drop old columns
     */
    public function up(): void
    {
        // ─────────────────────────────────────────────────────────────────
        // PLATFORMS: name → name_ar, name_en
        // ─────────────────────────────────────────────────────────────────
        Schema::table('platforms', function (Blueprint $table) {
            $table->string('name_ar')->nullable()->after('id');
            $table->string('name_en')->nullable()->after('name_ar');
        });

        DB::table('platforms')->update([
            'name_ar' => DB::raw('`name`'),
            'name_en' => DB::raw('`name`'),
        ]);

        Schema::table('platforms', function (Blueprint $table) {
            $table->string('name_ar')->nullable(false)->change();
            $table->string('name_en')->nullable(false)->change();
            $table->dropColumn('name');
        });

        // ─────────────────────────────────────────────────────────────────
        // CONTACTS: title → title_ar, title_en
        // ─────────────────────────────────────────────────────────────────
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('title_ar')->nullable()->after('type');
            $table->string('title_en')->nullable()->after('title_ar');
        });

        DB::table('contacts')->update([
            'title_ar' => DB::raw('`title`'),
            'title_en' => DB::raw('`title`'),
        ]);

        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn('title');
        });

        // ─────────────────────────────────────────────────────────────────
        // SERVICES:
        //   title_ar already exists (was renamed in a prior migration)
        //   Add: title_en, short_description_en, long_description_en,
        //        points_ar, points_en   (points → points_ar + points_en)
        // ─────────────────────────────────────────────────────────────────
        Schema::table('services', function (Blueprint $table) {
            $table->string('title_en')->nullable()->after('title_ar');
            $table->text('short_description_en')->nullable()->after('short_description_ar');
            $table->text('long_description_en')->nullable()->after('long_description_ar');
            $table->json('points_ar')->nullable()->after('long_description_en');
            $table->json('points_en')->nullable()->after('points_ar');
        });

        DB::table('services')->update([
            'title_en'             => DB::raw('`title_ar`'),
            'short_description_en' => DB::raw('`short_description_ar`'),
            'long_description_en'  => DB::raw('`long_description_ar`'),
            'points_ar'            => DB::raw('`points`'),
            'points_en'            => DB::raw('`points`'),
        ]);

        Schema::table('services', function (Blueprint $table) {
            $table->string('title_en')->nullable(false)->change();
            $table->text('short_description_en')->nullable(false)->change();
            $table->text('long_description_en')->nullable(false)->change();
            $table->dropColumn('points');
        });

        // ─────────────────────────────────────────────────────────────────
        // HOME SECTIONS:
        //   title, subtitle, description → *_ar, *_en
        // ─────────────────────────────────────────────────────────────────
        Schema::table('home_sections', function (Blueprint $table) {
            $table->string('title_ar')->nullable()->after('image');
            $table->string('title_en')->nullable()->after('title_ar');
            $table->string('subtitle_ar')->nullable()->after('title_en');
            $table->string('subtitle_en')->nullable()->after('subtitle_ar');
            $table->text('description_ar')->nullable()->after('subtitle_en');
            $table->text('description_en')->nullable()->after('description_ar');
        });

        DB::table('home_sections')->update([
            'title_ar'       => DB::raw('`title`'),
            'title_en'       => DB::raw('`title`'),
            'subtitle_ar'    => DB::raw('`subtitle`'),
            'subtitle_en'    => DB::raw('`subtitle`'),
            'description_ar' => DB::raw('`description`'),
            'description_en' => DB::raw('`description`'),
        ]);

        Schema::table('home_sections', function (Blueprint $table) {
            $table->string('title_ar')->nullable(false)->change();
            $table->string('title_en')->nullable(false)->change();
            $table->string('subtitle_ar')->nullable(false)->change();
            $table->string('subtitle_en')->nullable(false)->change();
            $table->text('description_ar')->nullable(false)->change();
            $table->text('description_en')->nullable(false)->change();
            $table->dropColumn(['title', 'subtitle', 'description']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // PLATFORMS
        Schema::table('platforms', function (Blueprint $table) {
            $table->string('name')->nullable()->after('id');
        });
        DB::table('platforms')->update(['name' => DB::raw('`name_ar`')]);
        Schema::table('platforms', function (Blueprint $table) {
            $table->dropColumn(['name_ar', 'name_en']);
        });

        // CONTACTS
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('title')->nullable()->after('type');
        });
        DB::table('contacts')->update(['title' => DB::raw('`title_ar`')]);
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn(['title_ar', 'title_en']);
        });

        // SERVICES
        Schema::table('services', function (Blueprint $table) {
            $table->json('points')->nullable()->after('long_description_ar');
        });
        DB::table('services')->update(['points' => DB::raw('`points_ar`')]);
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['title_en', 'short_description_en', 'long_description_en', 'points_ar', 'points_en']);
        });

        // HOME SECTIONS
        Schema::table('home_sections', function (Blueprint $table) {
            $table->string('title')->nullable()->after('image');
            $table->string('subtitle')->nullable()->after('title');
            $table->text('description')->nullable()->after('subtitle');
        });
        DB::table('home_sections')->update([
            'title'       => DB::raw('`title_ar`'),
            'subtitle'    => DB::raw('`subtitle_ar`'),
            'description' => DB::raw('`description_ar`'),
        ]);
        Schema::table('home_sections', function (Blueprint $table) {
            $table->dropColumn([
                'title_ar', 'title_en',
                'subtitle_ar', 'subtitle_en',
                'description_ar', 'description_en',
            ]);
        });
    }
};
