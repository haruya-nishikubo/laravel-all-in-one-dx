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
        Schema::create('route_policy_route_role', function (Blueprint $table) {
            $table->foreignId('route_policy_id')
                ->constrained();
            $table->foreignId('route_role_id')
                ->constrained();

            $table->unique([
                'route_policy_id',
                'route_role_id',
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
        Schema::dropIfExists('route_policy_route_role');
    }
};
