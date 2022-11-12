@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('project.store')  }}" >

    @csrf
    <h1 >Create Project</h1>

    <div class="field">
        <label class="label">Title</label>
        <div class="control">
            <input class="input" type="text" name="title" placeholder="Title input">
            @error('title')
            <small style=" color:darkred"> {{ $message }} </small>
            @enderror
        </div>
    </div>

    <div class="field">
        <label class="label">Description</label>
        <div class="control">
            <textarea class="textarea" name="description" placeholder="Textarea"></textarea>
            @error('description')
            <small style=" color:darkred"> {{ $message }} </small>
            @enderror
        </div>
    </div>

    <div class="field is-grouped">
        <div class="control">
            <button type="submit" class="button is-link">Submit</button>
            <a href="{{route('project.index')}}" class="button is-link">Cancel</a>
        </div>
    </div>
</form>
@endsection
