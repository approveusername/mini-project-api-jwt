<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function posts_view(Request $request){
        $posts = DB::table('posts')->orderBy('id','desc')->get();
        $post_found = false;
        if(!$posts->isEmpty()){
            $post_found = true;
        }
        return view('posts.index', compact('post_found'));
    }

    public function index()
    {
        $posts = DB::table('posts')->orderBy('id','desc')->get();
        if($posts){

            return response()->json($posts);
        }else{
            return response()->json(['message'=>'No post found!']);
        }
    }

    public function store(Request $request)
    {
        $request->validate(
        [
            'title' => 'required|string|max:255|min:3',
            'content' => 'required|string|min:3',
        ]);

        DB::table('posts')->insert([
            'title' => $request->title,
            'content' => $request->content,
        ]);
        return response()->json(['message'=>'post inserted successfuly!']);
    }

    public function show($id)
    {
        $post_data = DB::table('posts')->where('id', $id)->first();
        if ($post_data) {
            return response()->json($post_data);
        } else {
            return response()->json(['message'=>'post not found for entered id'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
        $updated = DB::table('posts')->where('id', $id)->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);
        

        if($updated) {
            return response()->json(['message'=>'post updated successfuly']);
        }else{
            return response()->json(['message' => 'post not found'], 404);
        }
    }

    public function destroy($id)
    {
        $deleted = DB::table('posts')->where('id', $id)->delete();

        if ($deleted) {
            return response()->json(['message' => 'post deleted successfuly']);
        } else {
            return response()->json(['message' => 'post not found'], 404);
        }
    }
}
