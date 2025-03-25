<x-admin>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <section class="section">
        <div class="row justify-content-center align-items-stretch">
            @if ($Categories->count() > 0)
                @foreach ($Categories as $category)
                    <div class="col-lg-4 col-md-6 d-flex">
                        <div class="card mb-4 text-center flex-fill">
                            <img src="{{ asset('assets/img/categories/' . $category->image) }}" class="card-img-top"
                                alt="{{ $category->name }}" style="height: 250px; object-fit: cover;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $category->name }}</h5>
                                <a href="{{ route('admin.EditCategory', $category->id) }}" class="btn btn-info">Edit
                                    Category</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12 text-center">
                    <p class="text-muted">No categories available at the moment.</p>
                </div>
            @endif
        </div>
    </section>
</x-admin>
