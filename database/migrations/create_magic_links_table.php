<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function __construct(private string $table)
    {
        $this->table = config('laravel-extended-auth.magic_links_table', 'magic_links');
    }

    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->id();
            $table->morphs('emailable');
            $table->string('token')->unique();
            $table->timestamp('expires_at');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop($this->table);
    }
};
