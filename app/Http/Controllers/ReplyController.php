<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests; 
use App\Post;
use App\Reply;
use Session;

class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'store']);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $post_id)
    {
        $this->validate($request, array( 
            'Reply'   =>  'required|min:1|max:2000'
        ));
        $post = Post::find($post_id);
        $Reply = new Reply(); 
        $Reply->name = Auth::user()->name; 
        $Reply->reply = $request->Reply; 
        $Reply->comment_id = $request->comment_id; 
        $Reply->save();
        Session::flash('success', 'Reply was added');
        return redirect('posts/'.$post_id);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Reply = Reply::find($id);
        return view('Replys.edit')->withReply($Reply);
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
        $Reply = Reply::find($id);
        $this->validate($request, array('Reply' => 'required'));
        $Reply->Reply = $request->Reply;
        $Reply->save();
        Session::flash('success', 'Reply updated');
        return redirect()->route('posts.show', $Reply->post->id);
    }
    public function delete($id)
    {
        $Reply = Reply::find($id);
        $post_id = $Reply->post->id;
        $Reply->delete();
        Session::flash('success', 'Deleted Reply');
        return redirect()->route('posts.show', $post_id);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Reply = Reply::find($id);
        $post_id = $Reply->post->id;
        $Reply->delete();
        Session::flash('success', 'Deleted Reply');
        return redirect()->route('posts.show', $post_id);
    }
}