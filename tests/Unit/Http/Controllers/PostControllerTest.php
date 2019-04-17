<?php

namespace Tests\Unit\Http\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery as m;
use App\Contracts\Repositories\PostRepository;
use App\Post;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\ParameterBag;
use Illuminate\Http\RedirectResponse;
use Faker\Factory as Faker;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @var \Mockery\Mock|Contracts\Repositories\PostRepository
     */

	protected $postMock;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function setup(): void {

        $this->afterApplicationCreated(function () {
            $this->postMock = m::mock($this->app->make(PostRepository::class))->makePartial();
        });
        parent::setUp();
    }


    public function test_index_return_view() {

    	$request = new Request();
        $request->headers->set('content-type', 'application/json');
        $request->query->set('page', 3);
        $posts = factory(Post::class, 15)->create();

        $mock = $this->mock(PostRepository::class, function ($mock) use ($posts){
            $mock->shouldReceive('paginate')->once()->with()->andReturn($posts);

        });

        $controller = new PostController($mock);
        
        $view = $controller->index($request);
        $this->assertEquals('post.list', $view->getName());
        //assertArraySubset: Asserts that an array has a specified subset.
        $this->assertArraySubset(['posts' => $posts], $view->getData());
        //assertArrayHasKey: Asserts that an array has a specified key (use with compact in controller)
        $this->assertArrayHasKey('posts', $view->getData()); 
    }

    /*public function test_index_return_view() {
        //dd($this->postMock);
        $controller = new PostController($this->postMock);
        $request = new Request();
        $request->headers->set('content-type', 'application/json');
        $request->query->set('page', 3);
        $posts = factory(Post::class, 15)->create();
        $this->postMock
            ->shouldReceive('paginate')
            ->once()
            ->andReturn($posts);
        
        $view = $controller->index($request);
        $this->assertEquals('post.list', $view->getName());
        //assertArraySubset: Asserts that an array has a specified subset.
        $this->assertArraySubset(['posts' => $posts], $view->getData());
        //assertArrayHasKey: Asserts that an array has a specified key (use with compact in controller)
        $this->assertArrayHasKey('posts', $view->getData());
    
    }*/

    public function test_it_stores_new_post() {

        $controller = new PostController($this->postMock);
        $data = [
            'title' => 'New City',
            'content' => 'Qui fugiat natus incidunt animi magni consequatur',
            'view' => 8,
            'vote' => 9,
            'status' => 1,
            'category_id' => 1,
            'slug' => 'Non cum dolorem iure deserunt doloribus consequuntur similiqueee.',
            'updated_at' => '2019-04-16 07:45:03',
            'created_at' => '2019-04-16 07:45:03'
        ];
        $request = new Request();
        $request->headers->set('content-type', 'application/json');
        //$request->setJson(new ParameterBag($data));
        $view = $controller->store($request);
        $this->assertEquals('post.list', $view->getName());
        $posts =$this->postMock->store($data);
        $this->assertInstanceOf(Post::class, $posts);
        $this->assertEquals($data['title'], $posts->title);
        $this->assertEquals($data['content'], $posts->content);
        $this->assertEquals($data['view'], $posts->view);
        $this->assertEquals($data['vote'], $posts->vote);
        $this->assertEquals($data['status'], $posts->status);
        $this->assertEquals($data['slug'], $posts->slug);

    }

     public function test_it_can_update_the_post()
    {
        $posts = factory(Post::class)->create();
        
        $data = [
            'title' => 'Laravel 1',
            'view' => 100,
            'vote' => 100,
        ];
        
        $update = $this->postMock->update($posts->id, $data);
        $post = $this->postMock->findOrFail($posts->id);
        
        $this->assertTrue($update);
        $this->assertEquals($data['title'], $post->title);
        $this->assertEquals($data['view'], $post->view);
        $this->assertEquals($data['vote'], $post->vote);
    }
}
