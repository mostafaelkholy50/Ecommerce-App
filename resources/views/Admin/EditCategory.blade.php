<x-admin>
   <div class="container py-5">
        <div class="category-profile mb-5">
            <div class="row">
                <div class="col-md-3 text-center">
                    <img id="categoryImage" src="{{ $categories->image ? asset('assets/img/categories/' . $categories->image) : asset('upload/Categories/Default.jpg') }}" class="categoryImage" alt="{{ $categories->name }}">
                </div>

                <div class="col-md-9">
                    <h1 class="mb-3">Edit Category</h1>
                    @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                    <form action="{{ route('admin.updateCategory', $categories->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="image" id="imageInput" class="form-control mt-2" accept="image/*" onchange="previewImage(event)">

                        <label class="mt-2"><strong>Category Name:</strong></label>
                        <input type="text" name="name" class="form-control" value="{{ $categories->name }}" required>

                        <label class="mt-2"><strong>Description:</strong></label>
                        <textarea name="description" class="form-control" required>{{ $categories->description }}</textarea>

                        <div class="d-flex justify-content-start gap-3 mt-4">
                            <button type="submit" class="btn btn-save">💾 Save Changes</button>
                            <button type="button" class="btn btn-delete" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal">🗑️ Delete Category</button>
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
                                    Are you sure you want to delete this category? This action cannot be undone!
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <form id="deleteForm" action="{{ route('admin.DeleteCategory', $categories->id) }}" method="post">
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
                console.log("New image loaded:", reader.result);
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</x-admin>
