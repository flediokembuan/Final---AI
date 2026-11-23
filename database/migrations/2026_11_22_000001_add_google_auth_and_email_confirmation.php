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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'google_id')) {
                $table->string('google_id')->nullable()->after('remember_token');
            }
            if (!Schema::hasColumn('users', 'avatar')) {
                $table->text('avatar')->nullable()->after('google_id');
            }
        });

        Schema::table('applications', function (Blueprint $table) {
            if (!Schema::hasColumn('applications', 'confirmation_email_sent_at')) {
                $table->timestamp('confirmation_email_sent_at')->nullable()->after('status');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['google_id', 'avatar']);
        });

        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn(['confirmation_email_sent_at']);
        });
    }
};
