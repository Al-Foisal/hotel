@forelse($categories as $category)

<div class="card">
    <div class="card-header">
        <h4 class="card-title">{{ $category->name }}</h4>
    </div><!--end card-header-->
    <div class="card-body">
        <div class="row">
            @if($category->menuItems->isEmpty())
            <div class="alert alert-danger p-2 text-center">
                No items found in this category
            </div>
            @else
            @foreach($category->menuItems as $item)
            <div class="col-md-4" style="cursor: pointer;">
                <div class="card-body border">
                    <div class="text-center">
                        <img src="{{asset($item->image)}}" height="70px" width="70px" alt="logo" class=" mb-2">
                    </div>
                    <hr>
                    <h4 class="text-center">{{ $item->name .' ৳'.number_format($item->price)}}</h4>
                </div>
            </div>
            @endforeach
            @endif

        </div>
    </div><!--end card -body-->
</div><!--end card-->
@empty
<div class="alert alert-danger p-2 text-center">
    No categories or products found.
</div>
@endforelse