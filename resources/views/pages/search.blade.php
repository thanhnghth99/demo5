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
                            <h4 class="m-0 text-uppercase font-weight-bold">Search: {{ $searchKeyword }}</h4>
                            <a class="text-secondary font-weight-medium text-decoration-none" href="">View All</a>
                        </div>
                    </div>
                    @foreach($dataArticles as $dataArticle)
                    <div class="col-lg-6">
                        <div class="position-relative mb-3">
                            <img class="img-fluid w-100" src="{{ asset('images/'.$dataArticle->image) }}" style="object-fit: cover; height: 250px !important;">
                            <div class="bg-white border border-top-0 p-4">
                                <div class="mb-2">
                                    <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2" href="{{ route('public.category', $dataArticle->categories[0]->id) }}">{{ $dataArticle->categories[0]->name }}</a><br>
                                    <a class="text-body" href=""><small>{{ $dataArticle->updated_at }}</small></a>
                                </div>
                                <div style="height: 100px;">
                                    <a style="display: -webkit-box !important;" class="h4 d-block mb-3 text-secondary text-uppercase font-weight-bold article-text-name" href="{{ route('public.article', $dataArticle->id) }}">
                                        {{ $dataArticle->name }}
                                    </a>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between bg-white border border-top-0 p-4">
                                <div class="d-flex align-items-center">
                                    <!-- <img class="rounded-circle mr-2" src="{{ asset('frontend/img/user.jpg') }}" width="25" height="25" alt=""> -->
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
                <div class="row">
                    <div class="mt-5">
                        {{ $dataArticles->links('vendor.pagination.bootstrap-4') }}
                    </div>
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