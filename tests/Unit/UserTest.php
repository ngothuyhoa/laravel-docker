<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Post;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\ModelTestCase;

class UserTest extends ModelTestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function test_model_configuration()
    {
        $this->runConfigurationAssertions(new User(),
        	[
            	'name', 'email', 'password'
		    ],
		    [
		    	'password', 'remember_token',
			]);
    }

    public function test_posts_relation()
    {
        $m = new User();
        $r = $m->posts();
        $this->assertHasManyRelation($r, $m, new Post());
    }
}
