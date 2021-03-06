<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminEthTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('admin_eth_transactions', function (Blueprint $table) {
            $table->increments('id'); 
            $table->text('sender');
            $table->text('recipient');
            $table->text('type');
            $table->text('amount');
            $table->text('txid'); 
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
        Schema::dropIfExists('admin_eth_transactions');
    }
}
