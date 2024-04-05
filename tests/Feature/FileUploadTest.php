<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FileUploadTest extends TestCase
{
    use RefreshDatabase;

    public function test_file_upload()
{
    Storage::fake('public');

    // 模拟上传文件
    $file = UploadedFile::fake()->image('featured_image.jpg');

    // 保存文件到 public 磁盘
    Storage::disk('public')->put('images/posts/featured-images/' . $file->getClientOriginalName(), $file->get());

    // 检查文件是否存在
    $this->assertTrue(Storage::disk('public')->exists('images/posts/featured-images/' . $file->getClientOriginalName()));
}
}
