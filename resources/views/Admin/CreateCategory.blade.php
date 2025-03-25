<x-admin>
    <section class="section">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h4 class="card-title text-center py-3">Create Category</h4>

                        <!-- تنبيه النجاح -->
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- تنبيه الأخطاء العامة -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.StoreCategory') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- اسم التصنيف -->
                            <div class="row mb-3">
                                <label for="categoryName" class="col-sm-3 col-form-label fw-bold">Category Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="categoryName" name="name" value="{{ old('name') }}"
                                        placeholder="Enter category name">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- تحميل الصورة -->
                            <div class="row mb-3">
                                <label for="formFile" class="col-sm-3 col-form-label fw-bold">Upload Image</label>
                                <div class="col-sm-9">
                                    <input class="form-control @error('image') is-invalid @enderror"
                                        type="file" id="formFile" name="image">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- وصف التصنيف -->
                            <div class="row mb-3">
                                <label for="categoryDescription" class="col-sm-3 col-form-label fw-bold">Description</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                        id="categoryDescription" name="description" rows="4"
                                        placeholder="Enter category description">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- زر الإرسال -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-success px-4">Create Category</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-admin>
