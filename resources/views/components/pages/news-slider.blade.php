<!-- Popular News Start -->
<div class="mb-3">
    <div class="section-title mb-0">
        <h4 class="m-0 text-uppercase font-weight-bold">Latest News</h4>
    </div>
    <div class="bg-white border border-top-0 p-3">
    @foreach($getArticle() as $article)
        <div class="d-flex align-items-center bg-white mb-3" style="height: 110px;">
            <img class="img-fluid" src="{{ asset('images/'.$article->image) }}" alt="">
            <div class="w-100 h-100 px-3 d-flex flex-column justify-content-center border border-left-0">
                <div class="mb-2">
                    <a class="badge badge-primary text-uppercase font-weight-semi-bold p-1 mr-2" href="{{ route('public.category', $article->categories[0]->id) }}">{{ $article->categories[0]->name }}</a><br>
                    <a class="text-body" href=""><small>{{ $article->updated_at }}</small></a>
                </div>
                <a class="h6 m-0 text-secondary text-uppercase font-weight-bold article-right-side" href="{{ route('public.article', $article->id) }}">{{ $article->name }}</a>
            </div>
        </div>
    @endforeach
    </div>
</div>
<!-- Popular News End -->