<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route_role_user', function (Blueprint $table) {
            $table->foreignId('route_role_id')
                ->constrained();
            $table->foreignId('user_id')
                ->constrained();

            $table->unique([
                'route_role_id',
                'user_id',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('route_role_user');
    }
};
