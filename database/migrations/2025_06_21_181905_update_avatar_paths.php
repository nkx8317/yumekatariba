<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateAvatarPaths extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 既存のユーザーの画像パスを新しい形式に更新
        DB::table('users')->whereNotNull('avatar')->update([
            'avatar' => DB::raw("CONCAT('img/avatars/', avatar)")
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // 元の形式に戻す
        DB::table('users')->whereNotNull('avatar')->update([
            'avatar' => DB::raw("SUBSTRING(avatar, 13)") // 'img/avatars/' の12文字を除去
        ]);
    }
}
