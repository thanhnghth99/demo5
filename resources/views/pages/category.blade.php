@extends('layouts.home')
@section('content')
<!-- News With Sidebar Start -->
<div class="container-fluid mt-5 pt-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <h4 class="m-0 text-uppercase font-weight-bold">Category: {{ $category->name }}</h4>
                            <a class="text-secondary font-weight-medium text-decoration-none" href="">View All</a>
                        </div>
                    </div>
                    @foreach($dataArticles as $dataArticle)
                    <div class="col-lg-6">
                        <div class="position-relative mb-3">
                            <img class="img-fluid w-100" src="{{ asset('images/'.$dataArticle->image) }}" style="object-fit: cover;">
                            <div class="bg-white border border-top-0 p-4">
                                <div class="mb-2">
                                    <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                        href="/category-list/{{ $category->id }}">{{ $category->name }}</a><br>
                                    <a class="text-body" href=""><small>{{ $dataArticle->updated_at }}</small></a>
                                </div>
                                <a class="h4 d-block mb-3 text-secondary text-uppercase font-weight-bold" href="/article-list/{{ $dataArticle->id }}">{{ $dataArticle->name }}</a>
                            </div>
                            <div class="d-flex justify-content-between bg-white border border-top-0 p-4">
                                <div class="d-flex align-items-center">
                                    <small>Author: {{ $dataArticle->authorInfo->name }}</small>
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
                <!-- Tags Start -->
                <div class="mb-3">
                    <div class="section-title mb-0">
                        <h4 class="m-0 text-uppercase font-weight-bold">Tags</h4>
                    </div>
                    <div class="bg-white border border-top-0 p-3">
                        <div class="d-flex flex-wrap m-n1">
                            @foreach($dataTags as $dataTag)
                                <a href="/tag-list/{{ $dataTag->id }}" class="btn btn-sm btn-outline-secondary m-1">{{ $dataTag->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- Tags End -->

                <!-- Popular News Start -->
                <div class="mb-3">
                    <div class="section-title mb-0">
                        <h4 class="m-0 text-uppercase font-weight-bold">Latest News</h4>
                    </div>
                    <div class="bg-white border border-top-0 p-3">
                    @foreach($articles as $article)
                        <div class="d-flex align-items-center bg-white mb-3" style="height: 110px;">
                            <img class="img-fluid" src="{{ asset('images/'.$article->image) }}" alt="">
                            <div class="w-100 h-100 px-3 d-flex flex-column justify-content-center border border-left-0">
                                <div class="mb-2">
                                    <a class="badge badge-primary text-uppercase font-weight-semi-bold p-1 mr-2" href="/category-list/{{ $article->categories[0]->id }}">{{ $article->categories[0]->name }}</a><br>
                                    <a class="text-body" href=""><small>{{ $article->updated_at }}</small></a>
                                </div>
                                <a class="h6 m-0 text-secondary text-uppercase font-weight-bold article-right-side" href="/article-list/{{ $article->id }}">{{ $article->name }}</a>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
                <!-- Popular News End -->

                @include('pages.social-media')

            </div>
        </div>
    </div>
</div>
<!-- News With Sidebar End -->
@endsection