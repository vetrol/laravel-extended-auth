<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function __construct(private string $table)
    {
        $this->table = config('laravel-extended-auth.user_email_addresses_table', 'user_email_addresses');
    }

    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->morphs('emailable');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop($this->table);
    }
};
