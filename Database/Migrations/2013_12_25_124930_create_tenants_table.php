<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auth_tenants', function (Blueprint $table) {
            $table->id();
            /** @noinspection PhpUndefinedMethodInspection */
            $table->efficientUuid('uuid')->index();
			$table->string('name');
			$table->foreignId('owner_id')->references('id')->on('auth_users');

            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
        });

        Schema::table('auth_users', function (Blueprint $table) {
            $table->foreignId('current_tenant_id')->nullable()->references('id')->on('auth_tenants');
        });

        Schema::create('auth_tenant_users', function (Blueprint $table) {
            $table->foreignId('user_id')->references('id')->on('auth_users');
            $table->foreignId('tenant_id')->references('id')->on('auth_tenants');

            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('auth_tenants');
        Schema::dropIfExists('auth_tenant_users');
        Schema::enableForeignKeyConstraints();
    }
}
