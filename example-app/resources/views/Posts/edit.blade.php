@extends('layouts.appLayouts')
@section ('title') edit @endsection

@section('content')

<main>
    <div class=" container-fluid px-4">
       
    
        <form method="POST" action="{{route('posts.update',$post->id)}}">
            @csrf
            @method('PUT')
            <label for="inputPassword3" class="col-sm-2 col-form-label">Title</label>
            <div class="row mb-3 ">
               
                <div class="col-sm-10">
                    <input class="form-control" id="inputPassword3" name="title" value="{{old('title',$post->title)}}">
    
                </div>
            </div>
            <label for="example" class="col-sm-2 col-form-label">description</label>
            <textarea id="example" name="description" ></textarea>
            <label  class="col-sm-2 col-form-label mt-3 mb-3">writer</label>
            <select class="form-select" name="post_creator" aria-label="Default select example">
    
                @foreach($admins as $admin)
                <option value="{{$admin->id}}">{{$admin->name}} </option>
                @endforeach
            </select>
            <div class="text-center">
                <button type="submit" class="btn btn-primary mt-3 ">Update</button>
            </div>
        </form>
    
    
    
    </div>
</main>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


@endsection
