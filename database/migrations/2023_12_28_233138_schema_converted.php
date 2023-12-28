<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE relatives MODIFY COLUMN parentId bigint(20) unsigned NOT NULL');
        DB::statement('ALTER TABLE relatives ADD CONSTRAINT relatives_parentid_foreign FOREIGN KEY (parentId) REFERENCES users (id)');
        DB::statement('ALTER TABLE users MODIFY COLUMN email varchar(255) NULL default null');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE users MODIFY COLUMN email varchar(255) NOT NULL');
        DB::statement('ALTER TABLE relatives DROP FOREIGN KEY relatives_parentid_foreign');
        DB::statement('ALTER TABLE relatives MODIFY COLUMN parentId bigint(20) unsigned NULL');
    }
};
