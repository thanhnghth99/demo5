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
                    <x-pages.data-article :items="$dataArticles" id="{{ $category->id }}" name="{{ $category->name }}"/>
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
                                <a href="{{ route('public.tag', $dataTag->id) }}" class="btn btn-sm btn-outline-secondary m-1">{{ $dataTag->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- Tags End -->

                <x-pages.news-slider/>

                @include('pages.social-media')

            </div>
        </div>
    </div>
</div>
<!-- News With Sidebar End -->
@endsection