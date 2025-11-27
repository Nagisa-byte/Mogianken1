<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id'); // 出品者
            $table->unsignedBigInteger('item_id'); // アイテム

            $table->string('postal_code', 8);
            $table->string('address', 255);
            $table->string('building', 255)->nullable();
            $table->string('payment_method', 50);

            $table->timestamps();

            // 外部キー制約
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade'); // ユーザー削除時に連動

            // 外部キー制約
            $table->foreign('item_id')
                ->references('id')
                ->on('items')
                ->onDelete('cascade'); // アイテム削除時に連動
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchases');
    }
}
