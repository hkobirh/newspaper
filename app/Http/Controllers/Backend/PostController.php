<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Category;
use Exception;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::select('id', 'title', 'description', 'status', 'image')->get();
        return view('backend.post.manage', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        return view('backend.post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'category_id' => 'required',
            'title'       => 'required',
            'description' => 'required',
            'image'       => 'required',
            'status'      => 'required'
        ]);
        $file = $request->file('image');
        $fileName = date('YmdHi.') . $file->getClientOriginalExtension();
        $post = Post::create([
            'user_id'     => Auth::id(),
            'category_id' => $request->category_id,
            'title'       => $request->title,
            'description' => $request->description,
            'image'       => $fileName,
            'status'      => $request->status,
        ]);

        if($post){
            $file->storeAs('post_images', $fileName);
        }
        //$file->move(public_path('uploads/post_img'), $fileName);

        Session()->flash('success', 'Post created successfully.');
        return redirect()->back();
    }


    /**
     * Display the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['posts'] = Post::find($id);
        $data['categories'] = Category::select('id', 'name', 'slug', 'status')->get();
        return view('backend.post.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $request->validate([
            'category_id' => 'required',
            'title'       => 'required',
            'description' => 'required',
            'image'       => 'required',
            'status'      => 'required'
        ]);
        try {
            $post->category_id = $request->category_id;
            $post->title = $request->title;
            $post->description = $request->description;
            $post->status = $request->status;
            if($request->file('image')){
                $file = $request->file('image');
                $fileName = date('YmdHi.') . $file->getClientOriginalExtension();
                $post->image = $fileName;
                $file->storeAs('post_images', $fileName);
            }
            $post->update();
            //$file->move(public_path('uploads/post_img'), $fileName);
            Session()->flash('success', 'Post updated successfully.');

        } catch (Exception $e) {
            Session()->flash('error', 'Post not updated.');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        Session()->flash('error', 'Post delete successfully.');
        return redirect()->back();
    }
}
