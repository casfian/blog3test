<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//add ne utk Storage delete
use Illuminate\Support\Facades\Storage;

//utk excel
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\PostsExport; //use this export
use App\Imports\PostsImport; //use this import

use App\Models\Post; //use this model
use App\Models\User; //add this


class PostController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show'] ]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Post::all();
        //$posts = Post::all();

        //For Pagination
        //$posts = Post::orderBy('id', 'DESC')->paginate(5);

        //semalam
        //$user_id = Auth()->User()->id;
        // $posts = Post::where("user_id", "=", $user_id )->get();
        // return view('posts.index')->with('posts', $posts);
        
        //guna join
        $user_id = Auth()->User()->id;
        $user = User::find($user_id);
        $posts = $user->posts()->orderBy('id', 'DESC')->paginate(5);

        //return view('posts.index', compact('posts'));
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'tajuk' => 'required|max:100',
                'kandungan' => 'required',
                'photo' => 'required|image|max:2048',
            ]
        );

        if($request->hasFile('photo')) {

            $fileNameWithExt = $request->file('photo')->getClientOriginalName();
            $filenameOnly = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $fileNameUpload = $filenameOnly.'_'.time().'.'.$request->photo->extension();
            $request->photo->move(public_path('public/uploads'), $fileNameUpload);

        } else {
            $fileNameUpload = "noimage.jpg";
        }
        
        $post = new Post;
        $post->tajuk = $request->tajuk;
        $post->kandungan = $request->kandungan;
        $post->user_id = Auth()->User()->id;
        $post->photo = $fileNameUpload;
        $post->save();

        return redirect('/posts')->with('success', 'Successful Add Post');
        //return redirect()->route('posts.index')->with('success', 'Successful Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        // return $post;
        return view('posts.edit')->with('post', $post);
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
        $validatedData = $request->validate(
            [
                'tajuk' => 'required|max:100',
                'kandungan' => 'required'
            ]
        );

        //code edit photo
        if($request->hasFile('photo')) {

            $fileNameWithExt = $request->file('photo')->getClientOriginalName();
            $filenameOnly = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $fileNameUpload = $filenameOnly.'_'.time().'.'.$request->photo->extension();
            $request->photo->move(public_path('uploads'), $fileNameUpload);

        }

        $post = Post::find($id);
        $post->tajuk = $request->tajuk;
        $post->kandungan = $request->kandungan;
        if($request->hasFile('photo')) {
            $post->photo = $fileNameUpload;
        }
        $post->save();

        return redirect('/posts')->with('success', 'Successful Update Post');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        Storage::delete('uploads'.$post->photo);

        $post->delete();
        return redirect('/posts')->with('success', 'Successful delete');

    }

    //export excel
    public function export() 
    {
        return Excel::download(new PostsExport, 'posts.xlsx');
    }

    //import excel
    public function import(Request $request) 
    {   
        Excel::import(new PostsImport, request()->file('excel_file'));

        return redirect('/posts')->with('success', 'Successful Import');
    }

    
}
