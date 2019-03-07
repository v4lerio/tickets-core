<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('priority_id'); // default priority for a ticket in this mailbox
            $table->unsignedInteger('department_id'); // default department for a ticket in this mailbox
            $table->string('email_address'); // what's our email address?
            $table->string('from_address')->nullable(); // optional from address
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->boolean('inbound_enabled')->default(true);
            $table->string('inbound_server');
            $table->integer('inbound_port');
            $table->enum('inbound_protocol', ['pop', 'imap']);
            $table->enum('inbound_encryption', ['none', 'ssl']);
            $table->integer('fetch_frequency')->default(1);
            $table->integer('fetch_amount')->default(5);
            $table->boolean('delete_on_fetch')->default(true); // should we delete email on fetch?
            $table->boolean('smtp_enabled')->default(true);
            $table->string('smtp_server');
            $table->integer('smtp_port');
            $table->boolean('smtp_auth_required')->default(true);
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
        Schema::dropIfExists('emails');
    }
}
