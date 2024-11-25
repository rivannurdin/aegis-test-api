<?php

use App\Models\Product;
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
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamp('date');
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->text('customer_address');
            $table->decimal('total_payment', 10, 2);
            $table->tinyInteger('status')->default(0)->comment('1:Paid: 2:Refund');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
