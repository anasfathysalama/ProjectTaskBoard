<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    private  $project;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct(Project $project)
    {
        $this->project = $project ;
    }

    public function view()
    {
        if (auth()->user()->isNot($this->project->owner)) {
            abort(403);
        }
        return true;
    }
}
