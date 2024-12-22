@extends('layouts.appLayouts')
@section ('title') trash @endsection

@section('content')


<div class=" container justify-content-around min-vh-100 align-items-center">


    <table class="table mt-4">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">title</th>
                <th scope="col">description</th>
                <th scope="col">posted by</th>
                <th scope="col">created at</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>


            @foreach($deletePosts as $post)
            <tr>
                <th scope="row">{{$post->id}}</th>
                <td>{!!$post -> title!!}</td>
                <td   class=" truncate-multiline" style="max-width: 250px;" >{!!$post->description!!}</td>
                <td>{{$post->user? $post->user->name : 'not found'}}</td>
                <td>{{$post-> created_at ->format('Y-M-d')}}</td>
                <td>

                    <a type="button" href="{{route ('posts.restore',$post['id'])}}" class="btn btn-success">Restore </a>


                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal2"
                        data-id="{{ $post->id }}">
                        Permanently Delete
                    </button>


                    <!-- Modal -->
                    <div class="modal fade" id="deleteModal2" tabindex="-1" aria-labelledby="deleteModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to permanently delete this item?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <form id="deleteForm2" method="POST">
                                        @csrf

                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


</div>
</div>
</div>
</div>


</td>
</tr>
<style>
    .truncate-multiline {
        display: -webkit-box;
        -webkit-line-clamp: 2; /* Number of lines to show */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>






@endforeach

</tbody>
</table>

</div>

@endsection