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
    @foreach ($posts as $post)
        <div class=" container d-flex justify-content-center mt-4  ">
            <div class=" card border-dark mb-3 w-75 g-3">

                <div class="card-body">
                    <div class="text-center">
                        <h5 class="card-title ">{{ $post['title'] }}

                        </h5>


                        <p id="time-count" class="text-muted ">
                        </p>

                        <div class="card-text " id="description">{!! $post['description'] !!}</div>

                        <div class="card-header">
                            <div class="meta mb-1 "><span class="date">published at

                                    {{ $post->created_at->format('Y-M-d') }} </span>
                            </div>
                        </div>
                    </div>


                    @if (!$post->comments->isEmpty())
                        <div class="card-header my-3">Comment</div>

                        @foreach ($post->comments as $comment)
                            <div class=" my-3">



                                <h6 class="ml-3">{{ $comment->comment }}</h6>
                                <hr>


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
                        </div>
                        <div class="intro">{{ $post->admin ? $post->admin->email : 'not found' }}</div>
                    </div>
                    <!--//col-->
                </div>
                <!--//row-->

            </div>
        </div>
        <!--//item-->
        <hr>
    @endforeach
@endsection
