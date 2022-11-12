<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function project_has_path()
    {
        $this->actingAs(User::factory()->create()) ;

        $project = Project::factory()->create();

        $this->assertEquals("/projects/{$project->id}", $project->path());
    }

    /** @test */
    public function project_belong_to_owner()
    {
        $project = Project::factory()->create();

        $this->assertInstanceOf(User::class , $project->owner );
    }

}
