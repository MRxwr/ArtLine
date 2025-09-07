@extends('storefront.layout')

@section('content')
<div class="container py-4">
    <!-- Banners Section -->
    @if($banners->count() > 0)
    <div id="bannerCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($banners as $index => $banner)
            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                <img src="{{ $banner->image_url }}" class="d-block w-100" alt="{{ $banner->title }}" style="height: 400px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block">
                    <h5>{{ $banner->title }}</h5>
                    @if($banner->link_url)
                        <a href="{{ $banner->link_url }}" class="btn btn-primary">Learn More</a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @if($banners->count() > 1)
        <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
        @endif
    </div>
    @endif

    <!-- Categories Section -->
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">Shop by Category</h2>
        </div>
        @foreach($categories as $category)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                @if($category->cover_url)
                <img src="{{ $category->cover_url }}" class="card-img-top" alt="{{ $category->title }}" style="height: 200px; object-fit: cover;">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $category->title }}</h5>
                    @if($category->subtitle)
                    <p class="card-text text-muted">{{ $category->subtitle }}</p>
                    @endif
                    @if($category->description)
                    <p class="card-text">{{ $category->description }}</p>
                    @endif
                    <a href="{{ route('storefront.category', [$store->slug, $category]) }}" class="btn btn-primary">
                        Browse Products
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Popup Banner Modal -->
@foreach($banners->where('show_as_popup', true) as $popupBanner)
<div class="modal fade" id="popupBanner{{ $popupBanner->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $popupBanner->title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                @if($popupBanner->video_youtube_id)
                <div class="ratio ratio-16x9">
                    <iframe src="https://www.youtube.com/embed/{{ $popupBanner->video_youtube_id }}" allowfullscreen></iframe>
                </div>
                @else
                <img src="{{ $popupBanner->image_url }}" class="img-fluid" alt="{{ $popupBanner->title }}">
                @endif
                @if($popupBanner->link_url)
                <div class="mt-3">
                    <a href="{{ $popupBanner->link_url }}" class="btn btn-primary">Learn More</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection

@push('scripts')
<script>
// Show popup banners (once per session)
@foreach($banners->where('show_as_popup', true) as $popupBanner)
if (!sessionStorage.getItem('popup_shown_{{ $popupBanner->id }}')) {
    var modal = new bootstrap.Modal(document.getElementById('popupBanner{{ $popupBanner->id }}'));
    modal.show();
    sessionStorage.setItem('popup_shown_{{ $popupBanner->id }}', 'true');
}
@endforeach
</script>
@endpush
