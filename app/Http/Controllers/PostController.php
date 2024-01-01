<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;



class PostController extends Controller
{
    protected $limited=5;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }
    public function index()
    {
        //return 'Controller -post list';
        // $data=[['id'=>1,'title'=>'hello'],['id'=>2,'title'=>'nice']];
        // return view('posts.index',['posts'=>$data]);

        //$posts=Post::all();
        $posts=Post::latest()->simplePaginate($this->limited);
        return view('posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        return view('posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required|max:90',
            'body'=>'required',
            'category_id'=>'required'
        ]);

        $post=new Post();
        $post->title=$request->title;
        $post->body=$request->body;
        $post->category_id=$request->category_id;
        $post->save();
        return redirect()->route('all.posts')
                ->with('successMsg','post add successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return "Controller -post show-{$id}";
        $post=Post::findOrFail($id);
        return view('posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $categories= [
        //     ["id"=>"1","name"=>"Political"],
        //     ["id"=>"2","name"=>"phone"]
        // ];
        $categories=Category::all();
        $post=Post::findOrFail($id);
        if(Gate::allows('post-edit',$post)){
            return view('posts.edit',compact(['categories','post']));
        }else{
            return redirect()->route('all.posts')
                   ->with('error','unauthorize');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post=Post::findOrFail($id);
        $post->title=$request->title;
        $post->body=$request->body;
        $post->category_id=$request->category_id;
        $post->user_id=auth()->user()->id;
        $post->save();
        return redirect()->route('all.posts')->with('successMsg','post edit successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::findOrFail($id);
        if(Gate::allows('post-delete',$post)){
            $post->delete();
            return redirect()->route('all.posts')->with('alertMsg','post delete successfully');
        }else{
            return redirect()->route('all.posts')
                   ->with('error','unauthorize');
        }
        
    }
}
