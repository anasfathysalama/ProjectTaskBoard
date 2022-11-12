@extends('layouts.app')

@section('content')

    <div class="flex items-center mt-4 mb-4">
        <h1 class="mr-auto">Projects</h1>
        <a href="{{route('project.create')}}">New Project</a>
    </div>

    <div class="cards flex">
        @forelse($projects as $project)
            <div class="card bg-white rounded mr-5 shadow w-1/3 p-5" style="height: 200px">
                <h3 class="font-normal text-xl mb-6">{{ $project->title  }}</h3>
                <div class="text-gray-500"> {{ str_limit($project->description) }}</div>
            </div>
        @empty
            <li>No projects .</li>
        @endforelse
    </div>
@endsection
