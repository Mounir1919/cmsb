<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class DropUnconfirmedUsersTable extends Migration
{
    public function up()
    {
        Schema::dropIfExists('unconfirmed_users');
    }

    public function down()
    {
        // You can add the code to recreate the table if needed
    }
}

