@foreach($items as $dataArticle)
<div class="col-lg-6">
    <div class="position-relative mb-3">
        <img class="img-fluid w-100" src="{{ asset('images/'.$dataArticle->image) }}" style="object-fit: cover;">
        <div class="bg-white border border-top-0 p-4">
            <div class="mb-2">
                <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                href="{{ route('public.category', $id) }}">{{ $name }}</a><br>
                <a class="text-body" href=""><small>{{ $dataArticle->updated_at }}</small></a>
            </div>
            <a class="h4 d-block mb-3 text-secondary text-uppercase font-weight-bold" href="{{ route('public.article', $dataArticle->id) }}">{{ $dataArticle->name }}</a>
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
