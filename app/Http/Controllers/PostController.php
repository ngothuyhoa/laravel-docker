<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\Repositories\PostRepository;

class PostController extends Controller
{
    protected $postRepository;
    
    public function __construct(
        PostRepository $postRepository
    ) {
        $this->postRepository = $postRepository;
    }

    public function index(Request $request)
    {
        $posts = $this->postRepository->paginate();
       
   		return view('post.list', compact('posts'));
    }

    public function store(Request $request)
    {
        
        return view('post.list');
    }
}
