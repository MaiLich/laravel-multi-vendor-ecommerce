<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('blog_posts', function (Blueprint $table) {
            // tên FK cũ mặc định: blog_posts_author_id_foreign
            $table->dropForeign(['author_id']);
            $table->foreign('author_id')->references('id')->on('admins')->cascadeOnDelete();
        });
    }
    public function down(): void {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
            $table->foreign('author_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }
};
