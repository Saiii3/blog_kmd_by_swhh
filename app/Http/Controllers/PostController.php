<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use App\Providers\HTMLPurifierService;

// Use the Post Model
use App\Models\Post;
// We will use Form Request to validate incoming requests from our store and update method
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use HTMLPurifier;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function welcome()
    {
        return view('welcome');
    }

    public function index()
    {
        $posts = Post::all(); // Fetch all posts

        return view('posts.index', compact('posts'));
    }

    public function media()
    {
        $mediaPosts = Post::where('category', 'Media')->get();

        $uniqueYears = Post::where('category', 'Media')
            ->select('year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        $latestYear = $uniqueYears->first();

        // 这里设置选中的年份
        $selectedYear = request()->get('year', $latestYear);  // 默认使用最新的年份

        return view('media', compact('mediaPosts', 'uniqueYears', 'latestYear', 'selectedYear'));
    }

    public function csr()
    {
        $csrPosts = Post::where('category', 'CSR')->get();

        // 从 'Media' 类别的帖子中获取所有不同的年份
        $uniqueYears = Post::where('category', 'CSR')
            ->select('year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        // 获取最新的年份
        $latestYear = $uniqueYears->first();
        $selectedYear = request()->get('year', $latestYear);  // 默认使用最新的年份

        return view('csr', compact('csrPosts', 'uniqueYears', 'latestYear', 'selectedYear'));
    }

    public function detail($id)
    {
        $post = Post::findOrFail($id);

        return view('detailpost', compact('post'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return response()->view('posts.form');
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(StoreRequest $request, HTMLPurifierService $htmlPurifierService): RedirectResponse
    {
        $validated = $request->validated();

        // 使用 HTMLPurifier 清洗 content 字段
        $purifiedContent = $htmlPurifierService->clean($request->input('content'));
        $validated['content'] = $purifiedContent;

        if ($request->hasFile('featured_image')) {
            // put image in the public storage
            $filePath = Storage::disk('public')->put('images/posts/featured-images', request()->file('featured_image'));
            $validated['featured_image'] = $filePath;
        }

        $validated['category'] = $request->input('category');

        // insert only requests that already validated in the StoreRequest
        $create = Post::create($validated);

        if ($create) {
            // add flash for the success notification
            session()->flash('notif.success', 'Post created successfully!');
            return redirect()->route('posts.index');
        }

        return abort(500);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        return response()->view('posts.show', [
            'post' => Post::findOrFail($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {
        return response()->view('posts.form', [
            'post' => Post::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id): RedirectResponse
    {
        $post = Post::findOrFail($id);
        $validated = $request->validated();

        if ($request->hasFile('featured_image')) {
            // delete image
            Storage::disk('public')->delete($post->featured_image);

            $filePath = Storage::disk('public')->put('images/posts/featured-images', request()->file('featured_image'), 'public');
            $validated['featured_image'] = $filePath;
        }

        if ($request->filled('category')) {
            $validated['category'] = $request->input('category');
        }

        $update = $post->update($validated);
        if ($update) {
            session()->flash('notif.success', 'Post updated successfully!');
            return redirect()->route('posts.index');
        }

        return abort(500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $post = Post::findOrFail($id);

        Storage::disk('public')->delete($post->featured_image);

        $delete = $post->delete($id);

        if ($delete) {
            session()->flash('notif.success', 'Post deleted successfully!');
            return redirect()->route('posts.index');
        }

        return abort(500);
    }
}
