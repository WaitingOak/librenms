<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('devices', 'snmp_context')) {
            Schema::table('devices', function (Blueprint $table) {
                $table->string('snmp_context', 128)->nullable()->after('community');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('devices', 'snmp_context')) {
            Schema::table('devices', function (Blueprint $table) {
                $table->dropColumn('snmp_context');
            });
        }
    }
};