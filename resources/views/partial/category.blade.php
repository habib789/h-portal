<div class='categories'>
    <p class="font-weight-bold text-uppercase">Browse Categories</p>
    @foreach($categories as $category)
        <a class="" href="{{ route('catList',$category->slug) }}">
            <div class="text-capitalize">
                <i class="fa fa-chevron-right"></i> &nbsp;{{ $category->name }}
            </div>
        </a>
    @endforeach
</div>
