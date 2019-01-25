<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable(); // user can be assigned after ticket creation
            $table->unsignedInteger('customer_id')->nullable(); // ditto with customer, might not know the customer up front. Especially if it's an e-mail ticket
            $table->unsignedInteger('department_id');
            $table->unsignedInteger('support_type_id')->nullable(); // might not know the support type up front. Especially on e-mail
            $table->unsignedInteger('priority_id');
            $table->text('subject');
            $table->enum('state', ['open', 'closed'])->default('open');
            $table->softDeletes();
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
        Schema::dropIfExists('tickets');
    }
}
