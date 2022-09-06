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
        if(!Schema::hasColumn('users','api_token')){
            Schema::table('users', function (Blueprint $table) {
                $table->string('api_token')->unique();
    
            });
        }
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(Schema::hasColumn('users','api_token')){
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('api_token');
    
            });
        }
    }
};
