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
use Faker\Factory as Faker;

class PostControllerTest extends TestCase
{
    //use RefreshDatabase;
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

    /** @test */
    public function it_can_create_a_post()
    {
        $faker = Faker::create();
        $data = [
            'category_id' => $faker->in,
            'title' => $faker->word,
            'link' => $faker->url,
            'src' => $faker->url,
        ];
      
        $carouselRepo = new CarouselRepository(new Carousel);
        $carousel = $carouselRepo->createCarousel($data);
      
        $this->assertInstanceOf(Carousel::class, $carousel);
        $this->assertEquals($data['title'], $carousel->title);
        $this->assertEquals($data['link'], $carousel->link);
        $this->assertEquals($data['src'], $carousel->src);
    }

    public function setup(): void {

    	$this->afterApplicationCreated(function () {
            $this->postMock = m::mock($this->app->make(PostRepository::class));
        });

        parent::setUp();
    }

    public function test_index_return_view() {

    	$controller = new PostController($this->postMock);
    	$request = new Request();
        $request->headers->set('content-type', 'application/json');
        $request->query->set('page', 3);
        $posts = factory(Post::class, 5)->create();


        // return view
        $view = $controller->index($request);
        //dump($view->getData());
        //dump(['posts' => $posts]);
        $this->assertEquals('post.list', $view->getName());
        //$this->assertArraySubset(['posts' => $posts], $view->getData());

        $this->postMock->shouldReceive('paginate')
            ->once() // method is called once
            ->andReturn($posts);

    }

}
