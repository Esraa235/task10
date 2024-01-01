<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all(); 
        // echo($posts);
       return  view('posts.index',compact('posts') );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return  view('posts.create' );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'description'=>'required',
             'image'=>'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
    //  * Display the specified resource.
        $post=new Post();
        $post->title=$request->input('title');
        $post->description=$request->input('description');
    
if($request->hasFile('image')){
    $image=$request->file('image');
    $imageName=time().'.'.$image->getClientOriginalExtension();
    $image->move(public_path('images'),$imageName);
    $post->image=$imageName;
}

      $post->save();
      return redirect()->route('posts.index')->with('success','post created successfuly');
    }

    public function show(Post $post)
    {
        return view('posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit',compact('post')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $post->update(['image' => $imageName]);
        }

        $post->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('posts.index')->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
      $post->delete();
      return redirect()->route('posts.index')->with('success','post deleted successfuly');

    }
}
