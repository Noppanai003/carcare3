<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use DB;
use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts',Post::all());
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

    public function autoprovince(Request $request)
    {
        if($request->get('query')){  
            $query = $request->get('query');
            $data = DB::table('provinces')->where('name_th', 'LIKE', "{$query}%") ->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
                
            foreach($data as $row){
              $output .= '<li><a href="#">'.$row->name_th.'</a></li>';
                    
            }
                
            $output .= '</ul>';
                    
            echo $output;

        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        // dd($request->all());
        $image=$request->image->store('posts');
        Post::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'content'=>$request->content,
            'image'=>$image
        ]);
        Session()->flash('success','บันทึกข้อมูลเรียบร้อยแล้ว');
        return redirect(route('posts.index'));
                // 'category_id'=>$request->category,
                // 'user_id'=>auth()->user()->id
        //   ]);
        //   if($request->tags){
        //           $post->tags()->attach($request->tags);
        //   }
         
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create')->with('post',$post);
        //   ->with('categories',Category::all())
        //   ->with('tags',Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request,Post $post)
    {
        $data=$request->only(['title','description','content']);
          if($request->hasFile('image')){ // มีภาพส่งมามั้ย
              $image=$request->image->store('post'); // สั่ง update
              $post->deleteImage(); // ลบรูปเดิม
              $data['image']=$image; // กำหนดก้อน Data
          }
        //   if($request->category){
        //       $data['category_id']=$request->category;
        //   }
        //   if($request->tags){
        //       $post->tags()->sync($request->tags);
        //   }
          $post->update($data); // ทำการ Update ข้อมูล
          Session()->flash('success','แก้ไขข้อมูลแล้ว');
          return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();//ลบข้อมูลในฐานข้อมูล
        // $post->tags()->detach($post->post_id);
        $post->deleteImage();
        Session()->flash('success','ลบข้อมูลแล้ว');
        return redirect(route('posts.index'));
    }
}
