<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Reply;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Session; 
use Purifier;
use Image;
use Storage; 

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(10); 

        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        if(!Auth::user()){
            return redirect('loginplz');
        }
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
        // validate the data
        $this->validate($request, array(
                'title' => 'required|max:255',  
                'body'  => 'required',
                'featured_image' => 'sometimes|image'
            ));

        // store in the database
        $post = new Post;

        $post->title = $request->title; 
        $post->author = Auth::user()->name; 
        $post->body = Purifier::clean($request->body, "youtube");

        if($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $filename = time().'-'.$image->getClientOriginalName();
            $location = public_path('images/'.$filename);
            Image::make($image)->save($location);

            $post->image = $filename;
        }

        $post->save(); 

        Session::flash('success', 'The App post was successfully saved!');

        return redirect()->route('posts.show', $post->id);
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
        $auth = Auth::check();
        $from = Post::where('id', $id)->first(); 
        $author = $from->author;
        $user = User::where('name', $author)->first();
        $avata = $user->avatar;
        $replies = Reply::all();
        return view('posts.show')->with('post', $post)->with('auth', $auth)->with('avata', $avata)->with('replies', $replies);
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
        $post = Post::find($id);

        $this->validate($request, array(
                'title' => 'required|max:255', 
                'body'  => 'required',
                'featured_image' => 'image'
            ));

        $post->title = $request->input('title'); 
        $post->body = Purifier::clean($request->input('body'), "youtube");

        if($request->hasFile('featured_image')) {

            $image = $request->file('featured_image');
            $filename = time().'-'.$image->getClientOriginalName();
            $location = public_path('images/'.$filename);
            Image::make($image)->save($location);

            $oldFilename = $post->image;

            $post->image = $filename;

            //comment this if you don't want to delete existing image
            Storage::delete($oldFilename);
        }

        $post->save(); 
        
        Session::flash('success', 'The App post was successfully updated!');

        return redirect()->route('posts.show', $post->id);
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

        //comment the code below if you don't want to delete the image even after the deleting the post
        // Storage::delete($post->image);

        $post->delete();

        Session::flash('success', 'The post was deleted');
        return redirect()->route('posts.index');
    }



    public function avatar()
    {
        return view('auth.avatar', array('user' => Auth::user()));
    }

    public function update_avatar(Request $request){
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time().'.'.$avatar->getClientOriginalExtension();  
            $location = public_path('avatars/'.$filename);
            Image::make($avatar)->resize(300, 300)->save($location);
            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
        }
        return redirect('avatar');
    }

    public function searchinput(){ 
        $search = urldecode(Input::get('search'));
        $posts = Post::select()->where('body', 'LIKE', '%'.$search.'%')->orderBy('id', 'desc')->get();

        if(count($posts)==0){
            return 'empty';
        } else {
            return view('posts.result')->with('posts', $posts);
        }        
    } 

}  