<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlgorithmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('algorithms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('text');
            $table->enum('actionType', ['bool', 'input', 'date'])->nullable();
            $table->string('positive')->nullable();
            $table->string('negative')->nullable();
            $table->integer('onPositive')->unsigned()->nullable();
            $table->integer('onNegative')->unsigned()->nullable();
            $table->integer('nextMove')->unsigned()->nullable();
            $table->string('tempPlan')->nullable();
            $table->string('conditionalFactor')->nullable();
            $table->string('conditionalOperator')->nullable();
            $table->string('conditionalValue')->nullable();
            $table->string('label')->nullable();
            $table->string('stateValue')->nullable();
            $table->string('progestogenPossible', ['true', 'false'])->nullable(); 
            $table->string('progestogenPossibleDir', ['positive', 'negative'])->nullable();  
            $table->string('tempPlanDirN')->nullable(); 
            $table->string('tempPlanDirP')->nullable(); 
            $table->integer('delay');
            $table->integer('series')->nullable();
            $table->enum('active', ['Y', 'N'])->default('N');
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
        Schema::dropIfExists('algorithms');
    }
}
