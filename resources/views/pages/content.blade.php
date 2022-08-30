@extends('layouts.home')
@section('content')
<!-- Main News Slider Start -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-7 px-0">
            <div class="owl-carousel main-carousel position-relative">
                @foreach($articles as $article)
                <div class="position-relative overflow-hidden" style="height: 500px;">
                    <img class="img-fluid h-100" src="{{ asset('images/'.$article->image) }}" style="object-fit: cover;">
                    <div class="overlay">
                        <div class="mb-2">
                            <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2" href="{{ route('public.category', $article->categories[0]->id) }}">{{ $article->categories[0]->name }}</a><br>
                            <a class="text-white" href="">{{ $article->updated_at }}</a>
                        </div>
                        <a class="h2 m-0 text-white text-uppercase font-weight-bold" href="{{ route('public.article', $article->id) }}">{{ $article->name }}</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-lg-5 px-0">
            <div class="row mx-0">
                @foreach($articles as $article)
                <div class="col-md-6 px-0">
                    <div class="position-relative overflow-hidden" style="height: 250px;">
                        <img class="img-fluid w-100 h-100" src="{{ asset('images/'.$article->image) }}" style="object-fit: cover;">
                        <div class="overlay">
                            <div class="mb-2">
                                <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2" href="{{ route('public.category', $article->categories[0]->id) }}">{{ $article->categories[0]->name }}</a><br>
                                <a class="text-white" href=""><small>{{ $article->updated_at }}</small></a>
                            </div>
                            <a class="h6 m-0 text-white text-uppercase font-weight-semi-bold" href="{{ route('public.article', $article->id) }}">{{ $article->name }}</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- Main News Slider End -->

<!-- Breaking News Start -->
<div class="container-fluid bg-dark py-3 mb-3">
    <div class="container">
        <div class="row align-items-center bg-dark">
            <div class="col-12">
                <div class="d-flex justify-content-between">
                    <div class="bg-primary text-dark text-center font-weight-medium py-2" style="width: 170px;">Breaking News</div>
                    <div class="owl-carousel tranding-carousel position-relative d-inline-flex align-items-center ml-3" style="width: calc(100% - 170px); padding-right: 90px;">
                        @foreach($articles as $article)
                        <div class="text-truncate"><a class="text-white text-uppercase font-weight-semi-bold" href="{{ route('public.article', $article->id) }}">{{ $article->name }}</a></div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breaking News End -->

<!-- News With Sidebar Start -->
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    @foreach($otherArticles as $otherArticle)
                    <div class="col-lg-6">
                        <div class="position-relative mb-3">
                            <img class="img-fluid w-100" src="{{ asset('images/'.$otherArticle->image) }}" style="object-fit: cover; height: 250px !important;">
                            <div class="bg-white border border-top-0 p-4">
                                <div class="mb-2">
                                    <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2" href="{{ route('public.category', $otherArticle->categories[0]->id) }}">{{ $otherArticle->categories[0]->name }}</a>
                                    <a class="text-body" href=""><small>{{ $otherArticle->updated_at }}</small></a>
                                </div>
                                <div style="height: 100px;">
                                    <a style="display: -webkit-box !important;" 
                                        class="h4 d-block mb-3 text-secondary text-uppercase font-weight-bold article-text-name" href="{{ route('public.article', $otherArticle->id) }}">
                                        {{ $otherArticle->name }}
                                    </a>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between bg-white border border-top-0 p-4">
                                <div class="d-flex align-items-center">
                                    <small>Author: {{ $otherArticle->authorInfo->name }}</small>
                                </div>
                                <div class="d-flex align-items-center">
                                    <small class="ml-3"><i class="far fa-eye mr-2"></i>12345</small>
                                    <small class="ml-3"><i class="far fa-comment mr-2"></i>123</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
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