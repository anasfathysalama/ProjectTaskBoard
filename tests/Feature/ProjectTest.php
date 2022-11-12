<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use WithFaker, RefreshDatabase;


    /** @test */
    public function geust_cannot_deal_with_projects()
    {
        $project = Project::factory()->create();
        $this->get('/projects')->assertRedirect('login');
        $this->get('/projects/create')->assertRedirect('login');
        $this->post('/projects', $project->toArray())->assertRedirect('login');
        $this->get($project->path())->assertRedirect('login');
    }



    /** @test */
    public function only_auth_user_can_create_project(): void
    {

        $this->be(User::factory()->create());

        $attributes = Project::factory()->raw(['owner_id' => auth()->id()]);

        $this->get('/projects/create')->assertStatus(200);

        $this->post('/projects', $attributes)->assertRedirect('/projects');

        $this->assertDatabaseHas('projects', $attributes);

        $this->get('/projects')->assertSee($attributes['title']);
    }


    /**
     * @test
     */
    public function auth_user_can_see_project()
    {

//        $this->withoutExceptionHandling();
        $this->be(User::factory()->create());


        $project = Project::factory()->create(['owner_id' => auth()->id()]);


        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);

    }


    /**
     * @test
     */
    public function validate_title_is_required()
    {
        $this->actingAs(User::factory()->create());

        $attributes = Project::factory()->raw(['title' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    /**
     * @test
     */
    public function validate_description_is_required()
    {
        $this->actingAs(User::factory()->create());

        $attributes = Project::factory()->raw(['description' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }

    /** @test */
    public function auth_user_can_see_thier_own_projects_only()
    {
        $this->actingAs(User::factory()->create());

        $project = Project::factory()->create();

        $this->get($project->path())->assertStatus(403);
    }


}
