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
        if (!Schema::hasTable('menu_items')) {
            Schema::create('menu_items', function (Blueprint $table) {
                $table->id();
                $table->string('menu_type', 50)->default('header'); // header, mega_services, portfolio_menu, footer_col1, footer_col2, footer_col3, footer_col4
                $table->unsignedBigInteger('parent_id')->nullable();
                $table->string('title');
                $table->string('url')->default('#');
                $table->string('category_group', 100)->nullable(); // e.g. "01 DIGITAL MARKETING", "02 CONTENT AND REPUTATION", "03 WEBSITES AND PRODUCTS"
                $table->string('icon', 255)->nullable();
                $table->text('description')->nullable();
                $table->string('target', 20)->default('_self');
                $table->integer('sort_order')->default(0);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('partner_logos')) {
            Schema::create('partner_logos', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('logo_path')->nullable();
                $table->string('website_url')->nullable();
                $table->integer('sort_order')->default(0);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partner_logos');
        Schema::dropIfExists('menu_items');
    }
};
