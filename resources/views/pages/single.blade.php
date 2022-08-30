@extends('layouts.home')
@section('content')

<!-- News With Sidebar Start -->
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- News Detail Start -->
                <div class="position-relative mb-3 detailed-article">
                    <img class="img-fluid w-100" src="{{ asset('images/'.$article->image) }}" style="object-fit: cover;">
                    <div class="bg-white border border-top-0 p-4">
                        <div class="mb-3">
                            <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2" href="{{ route('public.category', $article->categories[0]->id) }}">{{ $article->categories[0]->name }}</a><br>
                            <a class="text-body" href="">{{ $article->updated_at }}</a>
                        </div>
                        <h1 class="mb-3 text-secondary text-uppercase font-weight-bold">{{ $article->name }}</h1>
                        <div>
                            {!! $article->content !!}
                        </div>
                        <div class="text-secondary font-weight-bold">Relative tags:
                            <div class="d-flex flex-wrap m-n1">
                                @foreach($dataTags as $dataTag)
                                <a href="{{ route('public.tag', $dataTag->id) }}" class="btn btn-sm btn-outline-secondary m-1">{{ $dataTag->name }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between bg-white border border-top-0 p-4">
                        <div class="d-flex align-items-center">
                            <span>Author: {{ $article->authorInfo->name }}</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="ml-3"><i class="far fa-eye mr-2"></i>12345</span>
                            <span class="ml-3"><i class="far fa-comment mr-2"></i>123</span>
                        </div>
                    </div>
                </div>
                <!-- News Detail End -->

                <!-- Comment List Start -->
                <div class="mb-3">
                    <div class="section-title mb-0">
                        <h4 class="m-0 text-uppercase font-weight-bold">Comments</h4>
                    </div>
                    <div class="bg-white border border-top-0 p-4">
                        <div class="media mb-4">
                            <!-- <img src="img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;"> -->
                            <div class="media-body">
                                <h6><a class="text-secondary font-weight-bold" href="">John Doe</a> <small><i>01 Jan 2045</i></small></h6>
                                <p>Diam amet duo labore stet elitr invidunt ea clita ipsum voluptua, tempor labore
                                    accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed sed eirmod ipsum.</p>
                                <button class="btn btn-sm btn-outline-secondary">Reply</button>
                            </div>
                        </div>
                        <div class="media">
                            <!-- <img src="img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;"> -->
                            <div class="media-body">
                                <h6><a class="text-secondary font-weight-bold" href="">John Doe</a> <small><i>01 Jan 2045</i></small></h6>
                                <p>Diam amet duo labore stet elitr invidunt ea clita ipsum voluptua, tempor labore
                                    accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed sed eirmod ipsum.</p>
                                <button class="btn btn-sm btn-outline-secondary">Reply</button>
                                <div class="media mt-4">
                                    <!-- <img src="img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;"> -->
                                    <div class="media-body">
                                        <h6><a class="text-secondary font-weight-bold" href="">John Doe</a> <small><i>01 Jan 2045</i></small></h6>
                                        <p>Diam amet duo labore stet elitr invidunt ea clita ipsum voluptua, tempor
                                            labore accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed sed
                                            eirmod ipsum.</p>
                                        <button class="btn btn-sm btn-outline-secondary">Reply</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Comment List End -->

                <!-- Comment Form Start -->
                <div class="mb-3">
                    <div class="section-title mb-0">
                        <h4 class="m-0 text-uppercase font-weight-bold">Leave a comment</h4>
                    </div>
                    <div class="bg-white border border-top-0 p-4">
                        <form>
                            <div class="form-row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="name">Name *</label>
                                        <input type="text" class="form-control" id="name">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="email">Email *</label>
                                        <input type="email" class="form-control" id="email">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="website">Website</label>
                                <input type="url" class="form-control" id="website">
                            </div>

                            <div class="form-group">
                                <label for="message">Message *</label>
                                <textarea id="message" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                            <div class="form-group mb-0">
                                <input type="submit" value="Leave a comment" class="btn btn-primary font-weight-semi-bold py-2 px-3">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Comment Form End -->
            </div>

            <div class="col-lg-4">

                <x-pages.tag-slider />

                <x-pages.news-slider />

                @include('pages.social-media')

            </div>
        </div>
    </div>
</div>
<!-- News With Sidebar End -->

@endsection