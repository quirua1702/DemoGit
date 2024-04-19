<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
	{
		Schema::create('goidata', function (Blueprint $table) {
		$table->id();
		$table->foreignId('loaigoidata_id')->constrained('loaigoidata');
		$table->foreignId('tengoidata_id')->constrained('tengoidata');
		$table->string('tengoicuoc');
		$table->string('tengoicuoc_slug');
//$table->integer('soluong');
		$table->double('dongia');
		$table->string('hinhanh')->nullable();
		$table->text('thongtingoicuoc')->nullable();
		$table->timestamps();
		$table->engine = 'InnoDB';
		});
	}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goi_datas');
    }
};
