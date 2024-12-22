@extends('layouts.appLayouts')
@section('title')
    index
@endsection

@section('content')
    <main>
        <div class="container-fluid px-4 mb-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Posts Table
                </div>
                <div class="card-body">

                    <div class="d-flex mb-3">
                        <div class="p-2"><a
                                href="{{ route('posts.manage', ['sort_field' => 'created_at', 'sort_order' => $sortField == 'created_at' && $sortOrder == 'asc' ? 'desc' : 'asc']) }}"class="btn btn-outline-secondary btn-sm ">Order
                                by Date ↑ or ↓
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-layer-backward ml-1" viewBox="0 0 16 16">
                                    <path
                                        d="M8.354 15.854a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 0-.708l1-1a.5.5 0 0 1 .708 0l.646.647V4H1a1 1 0 0 1-1-1V1a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H9v7.793l.646-.647a.5.5 0 0 1 .708 0l1 1a.5.5 0 0 1 0 .708z" />
                                    <path
                                        d="M1 9a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h4.5a.5.5 0 0 1 0 1H1v2h4.5a.5.5 0 0 1 0 1zm9.5 0a.5.5 0 0 1 0-1H15V6h-4.5a.5.5 0 0 1 0-1H15a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1z" />
                                </svg>
                            </a></div>
                        <div class="p-2"><a
                                href="{{ route('posts.manage', ['sort_field' => 'id', 'sort_order' => $sortField == 'id' && $sortOrder == 'asc' ? 'desc' : 'asc']) }}"class="btn btn-outline-secondary btn-sm ">Order
                                by ID ↑ or ↓
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-layer-backward ml-1" viewBox="0 0 16 16">
                                    <path
                                        d="M8.354 15.854a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 0-.708l1-1a.5.5 0 0 1 .708 0l.646.647V4H1a1 1 0 0 1-1-1V1a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H9v7.793l.646-.647a.5.5 0 0 1 .708 0l1 1a.5.5 0 0 1 0 .708z" />
                                    <path
                                        d="M1 9a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h4.5a.5.5 0 0 1 0 1H1v2h4.5a.5.5 0 0 1 0 1zm9.5 0a.5.5 0 0 1 0-1H15V6h-4.5a.5.5 0 0 1 0-1H15a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1z" />
                                </svg>
                            </a></div>
                        <div class="ms-auto p-2"><a href="{{ route('posts.trash') }}"
                                class="btn btn-outline-danger btn-sm">trash
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-trash3 ml-1" viewBox="0 0 16 16">
                                    <path
                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <table class="table mt-4">
                        <thead>
                            <tr>
                                <th scope="col"> #</th>
                                <th scope="col">title</th>
                                <th scope="col">description</th>
                                <th scope="col">posted by</th>
                                <th scope="col">created at</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="posts-table">



                            @foreach ($posts as $post)
                                <tr>
                                    <th scope="row">{{ $post->id }} </th>
                                    <td>{!! $post->title !!}</td>
                                    <td class=" truncate-multiline" style="max-width: 250px;">{!! $post->description !!}</td>
                                    <td>{{ $post->admin ? $post->admin->name : 'not found' }}</td>
                                    <td>{{ $post->created_at->format('Y-M-d') }}</td>
                                    <td>

                                        <a href="{{ route('posts.show', $post['id']) }}" class="btn btn-info mb-1">view</a>
                                        <a type="button" href="{{ route('posts.edit', $post['id']) }}"
                                            class="btn btn-primary mb-1">Update</a>



                                        <a type="button" class="btn btn-danger mb-1" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal" data-id="{{ $post->id }}">
                                            Delete
                                        </a>



                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>




            </div>
            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this item?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <form id="deleteForm" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <hr>
            {{-- user table --}}
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Users Table
                </div>
                <div class="card-body">
                    <div>
                        <div class="d-flex mb-3">
                            <div class="p-2">
                                <a id="sortButton"
                                    href="{{ route('posts.manage', ['sort_field' => 'created_at', 'sort_order' => $sortField == 'created_at' && $sortOrder == 'asc' ? 'desc' : 'asc']) }}"
                                    class="btn btn-outline-secondary btn-sm">
                                    Order by Date ↑ or ↓
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-layer-forward ml-1" viewBox="0 0 16 16">
                                        <path
                                            d="M8.354 15.854a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 0-.708l1-1a.5.5 0 0 1 .708 0l.646.647V4H1a1 1 0 0 1-1-1V1a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H9v7.793l.646-.647a.5.5 0 0 1 .708 0l1 1a.5.5 0 0 1 0 .708z" />
                                        <path
                                            d="M1 9a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h4.5a.5.5 0 0 1 0 1H1v2h4.5a.5.5 0 0 1 0 1zm9.5 0a.5.5 0 0 1 0-1H15V6h-4.5a.5.5 0 0 1 0-1H15a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1z" />
                                    </svg>
                                </a>
                            </div>

                            <div class="p-2"><a
                                    href="{{ route('posts.manage', ['sort_field' => 'id', 'sort_order' => $sortField == 'id' && $sortOrder == 'asc' ? 'desc' : 'asc']) }}"class="btn btn-outline-secondary btn-sm ">Order
                                    by ID ↑ or ↓
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-layer-forward ml-1" viewBox="0 0 16 16">
                                        <path
                                            d="M8.354 15.854a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 0-.708l1-1a.5.5 0 0 1 .708 0l.646.647V4H1a1 1 0 0 1-1-1V1a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H9v7.793l.646-.647a.5.5 0 0 1 .708 0l1 1a.5.5 0 0 1 0 .708z" />
                                        <path
                                            d="M1 9a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h4.5a.5.5 0 0 1 0 1H1v2h4.5a.5.5 0 0 1 0 1zm9.5 0a.5.5 0 0 1 0-1H15V6h-4.5a.5.5 0 0 1 0-1H15a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1z" />
                                    </svg>
                                </a></div>
                        </div>
                        <table class="table mt-4">
                            <thead>
                                <tr>
                                    <th scope="col"> #</th>
                                    <th scope="col">name</th>
                                    <th scope="col">email</th>
                                    <th scope="col">created at</th>
                                </tr>
                            </thead>
                            <tbody id="posts-table">


                                @foreach ($users as $user)
                                    <tr>
                                        <th scope="row">{{ $user->id }} </th>
                                        <td>{!! $user->name !!}</td>
                                        <td class=" truncate-multiline" style="max-width: 250px;">{!! $user->email !!}
                                        </td>

                                        <td>{{ $user->created_at->format('Y-M-d') }}</td>
                                        <td>
                                            <div class="modal fade" id="deleteModal" tabindex="-1"
                                                aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel">Confirm Delete
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete this item?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <form id="deleteForm" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                    </div>
                </div>
            </div>
            </td>
            </tr>
            @endforeach
            </tbody>
            </table>

        </div>

    </main>
@endsection
<style>
    .truncate-multiline {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        /* Number of lines to show */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>

<script>
    document.getElementById('sortButton').addEventListener('click', function() {
        const sortIcon = document.getElementById('sortIcon');
        if (sortIcon.classList.contains('glyphicon glyphicon-cloud')) {
            sortIcon.classList.remove('glyphicon glyphicon-cloud');
            sortIcon.classList.add('glyphicon glyphicon-remove'); // Change to the upside-down icon
        } else {
            sortIcon.classList.remove(' glyphicon glyphicon-remove');
            sortIcon.classList.add('glyphicon glyphicon-cloud');
        }
    });
</script>
