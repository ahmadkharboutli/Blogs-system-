@extends('layouts.appLayouts')
@section('title')
    creat
@endsection

@section('content')



    <main>
        <div class="container-fluid px-4">
            <form method="POST" action="{{ route('posts.store', $post->id) }}">
                @csrf
                <label for="example2" class="col-sm-2 col-form-label">Title</label>
                <div class="row mb-3 ">

                    <div class="col-sm-10 ">
                        <input class="form-control" id="example2" name="title" value="{{ old('title') }}">
                    </div>
                </div>
                <label for="example" class="col-sm-2 col-form-label">description</label>
                <textarea id="example" name="description" value="{{ old('description') }}"></textarea>
                <select class="form-select mt-3" name="post_creator" aria-label="Default select example ">

                    @foreach ($admins as $admin)
                        <option value="{{ $admin->id }}">{{ $admin->name }} </option>
                    @endforeach
                </select>
                <div class="text-center">
                    <button type="submit" class="btn btn-success mt-3 ">Submit</button>
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
