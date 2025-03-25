<x-admin>
    <section class="section">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h4 class="card-title text-center py-3">Create Product</h4>

                        <!-- تنبيه النجاح -->
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- تنبيه الأخطاء -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.StoreProduct') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- اسم المنتج -->
                            <div class="row mb-3">
                                <label for="productName" class="col-sm-3 col-form-label fw-bold">Product Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="productName" name="name" value="{{ old('name') }}"
                                        placeholder="Enter product name">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- اختيار التصنيف -->
                            <div class="row mb-3">
                                <label for="category" class="col-sm-3 col-form-label fw-bold">Category</label>
                                <div class="col-sm-9">
                                    <select class="form-select @error('category_id') is-invalid @enderror"
                                        id="category" name="category_id">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- السعر -->
                            <div class="row mb-3">
                                <label for="price" class="col-sm-3 col-form-label fw-bold">Price ($)</label>
                                <div class="col-sm-9">
                                    <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror"
                                        id="price" name="price" value="{{ old('price') }}"
                                        placeholder="Enter product price">
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- المخزون -->
                            <div class="row mb-3">
                                <label for="stock" class="col-sm-3 col-form-label fw-bold">Stock Quantity</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control @error('stock') is-invalid @enderror"
                                        id="stock" name="stock" value="{{ old('stock') }}"
                                        placeholder="Enter stock quantity">
                                    @error('stock')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- تحميل الصورة -->
                            <div class="row mb-3">
                                <label for="productImage" class="col-sm-3 col-form-label fw-bold">Upload Image</label>
                                <div class="col-sm-9">
                                    <input class="form-control @error('image') is-invalid @enderror"
                                        type="file" id="productImage" name="image">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- وصف المنتج -->
                            <div class="row mb-3">
                                <label for="productDescription" class="col-sm-3 col-form-label fw-bold">Description</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                        id="productDescription" name="description" rows="4"
                                        placeholder="Enter product description">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- زر الإرسال -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-success px-4">Create Product</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
</x-admin>
