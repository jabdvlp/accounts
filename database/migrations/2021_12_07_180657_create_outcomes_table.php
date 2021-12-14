<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;


class CreateOutcomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
        Schema::create('outcomes', function (Blueprint $table) {
            $table->uuid('id')
                  ->primary();
            $table->decimal('amount', $precision = 9, $scale = 2);
            $table->foreignUuid('concept_id')
                  ->constrained('concepts');
            $table->foreignUuid('account_id')
                  ->nullable()
                  ->constrained('accounts');
            $table->foreignUuid('movement_id')
                  ->nullable()
                  ->constrained('movements');
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('outcomes');
    }
}
