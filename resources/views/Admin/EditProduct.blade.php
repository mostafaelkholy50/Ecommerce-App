<x-admin>
   <div class="container py-5">
        <div class="category-profile mb-5">
            <div class="row">
                <div class="col-md-3 text-center">
                    <img id="categoryImage" src="{{ asset('assets/img/products/' . $products->image) }}" class="categoryImage" alt="{{ $products->name }}">
                </div>

                <div class="col-md-9">
                    <h1 class="mb-3">Edit Product</h1>
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form action="{{ route('admin.updateProduct', $products->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="image" id="imageInput" class="form-control mt-2" accept="image/*" onchange="previewImage(event)">
                        @error('image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                        <label class="mt-2"><strong>Product Name:</strong></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $products->name) }}" required>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                        <label class="mt-2"><strong>Description:</strong></label>
                        <textarea name="description" class="form-control" required>{{ old('description', $products->description) }}</textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                        <label class="mt-2"><strong>Price:</strong></label>
                        <input type="number" name="price" class="form-control" value="{{ old('price', $products->price) }}" required>
                        @error('price')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                        <label class="mt-2"><strong>Stock:</strong></label>
                        <input type="number" name="stock" class="form-control" value="{{ old('stock', $products->stock) }}" required>
                        @error('stock')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                        <label class="mt-2"><strong>Category:</strong></label>
                        <select name="category_id" class="form-control" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $products->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                        <div class="d-flex justify-content-start gap-3 mt-4">
                            <button type="submit" class="btn btn-save">💾 Save Changes</button>
                            <button type="button" class="btn btn-delete" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal">🗑️ Delete Product</button>
                        </div>
                    </form>

                    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteConfirmModalLabel">Confirm Deletion</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this product? This action cannot be undone!
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <form id="deleteForm" action="{{ route('admin.deleteProduct', $products->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            let reader = new FileReader();
            reader.onload = function () {
                let output = document.getElementById('categoryImage');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</x-admin>
