@extends('layouts.appLayouts')
@section('title')
    show
@endsection
@section('content')


    <section class="cta-section theme-bg-light py-5">
        <div class="container text-center single-col-max-width">
            <h2 class="heading"><span class=" badge rounded-pill text-bg-success ">Hyber Blog</span> - The largest scientific
                articles site</h2>
        </div>
        <!--//container-->
    </section>
    <div class=" container d-flex justify-content-center mt-4 g-3 ">
        <div class=" card border-dark mb-3 w-75">

            <div class="card-body">
                <h5 class="card-title text-center">{{ $post['title'] }}

                </h5>
                <p class="text-center">
                    <span id="time-count" class="text-muted">
                    </span>
                </p>
                <div class="card-text" id="description">{!! $post['description'] !!}</div>

                <div class="card-header">
                    <div class="meta mb-1 text-center"><span class="date">published at

                            {{ $post->created_at->format('Y-M-d') }} </span>
                    </div>
                </div>
                @if (session('comments'))
                    @foreach (session('comments') as $comment)
                        <div class="card mb-3 mt-3">
                            <div class="card-header">Comment</div>

                            <div class="card-body">
                                <blockquote class="blockquote mb-0">
                                    <p>{{ $comment->comment }}</p>
                                </blockquote>

                            </div>
                        </div>
                    @endforeach
                @endif

            </div>


        </div>
    </div>


    <div class="container text-center justify-content-center mt-4 w-75 ">
        <div class="item mb-5 ">
            <div class="row g-3 g-xl-0">

                <div class="col">
                    <h3 class="title mb-1">
                        <p class="text-link" href="blog-post.html">writer info</p>
                    </h3>
                    <div class="meta mb-1"><span class="date">published by
                            {{ $post->admin ? $post->admin->name : 'not found' }}</span>
                        <!-- <span class="comment"><a class="text-link" href="#">8 comments</a></span> -->
                    </div>
                    <div class="intro">{{ $post->admin ? $post->admin->email : 'not found' }}</div>
                    <!-- <a class="text-link" href="blog-post.html">Read more &rarr;</a> -->
                </div>
                <!--//col-->
            </div>
            <!--//row-->
        </div>
        <!--//item-->

    @endsection
