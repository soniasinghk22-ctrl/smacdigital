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
        if (Schema::hasTable('blogs')) {
            Schema::table('blogs', function (Blueprint $table) {
                if (!Schema::hasColumn('blogs', 'metatitle')) {
                    $table->string('metatitle')->nullable()->after('schema_markup');
                }
                if (!Schema::hasColumn('blogs', 'metadescription')) {
                    $table->text('metadescription')->nullable()->after('metatitle');
                }
                if (!Schema::hasColumn('blogs', 'metakeywords')) {
                    $table->text('metakeywords')->nullable()->after('metadescription');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('blogs')) {
            Schema::table('blogs', function (Blueprint $table) {
                $columnsToDrop = [];
                if (Schema::hasColumn('blogs', 'metatitle')) {
                    $columnsToDrop[] = 'metatitle';
                }
                if (Schema::hasColumn('blogs', 'metadescription')) {
                    $columnsToDrop[] = 'metadescription';
                }
                if (Schema::hasColumn('blogs', 'metakeywords')) {
                    $columnsToDrop[] = 'metakeywords';
                }
                if (!empty($columnsToDrop)) {
                    $table->dropColumn($columnsToDrop);
                }
            });
        }
    }
};
