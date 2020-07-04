<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained()->onDelete(null);
            $table->boolean('status')->default(false);
            $table->boolean('is_blocked')->default(false);
            $table->string('username')->unique();
            $table->string('name')->nullable();
            $table->string('location')->nullable();
            $table->string('website')->nullable();
            $table->string('bio')->nullable();
            $table->string('email')->unique();
            $table->string('provider')->nullable();
            $table->string('provider_token')->nullable();
            $table->string('password')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('last_seen_at')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
