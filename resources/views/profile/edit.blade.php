<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="bg-gray-900 min-h-screen text-white" style="margin-top: 110px;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- تحديث صورة البروفايل -->
            <div class="p-4 sm:p-8 bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl mx-auto">
                    <div class="flex flex-col md:flex-row items-center">
                        <!-- صورة المستخدم -->
                        <div class="md:w-1/4 mb-4 md:mb-0 md:mr-4 text-center">
                            <img id="userImage"
                                 src="{{ asset('assets/img/User/' . auth()->user()->Image) }}"
                                 alt="User Image"
                                 class="w-50 h-50 rounded-full object-cover mx-auto">
                        </div>
                        <!-- نموذج رفع الصورة -->
                        <div class="md:w-3/4">
                            <h3 class="text-lg font-semibold text-white mb-4">Update Profile Picture</h3>
                            <form method="POST" action="{{ route('user.update') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4">
                                    <label class="block text-sm font-medium mb-2">Profile Image</label>
                                    <input type="file" name="image" accept="image/*" id="imageInput"
                                        class="block w-full text-sm text-gray-300 bg-gray-700 border border-gray-600 rounded-lg cursor-pointer">
                                    @error('image')
                                        <p class="text-sm mt-1 text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                <button type="submit"
                                    class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                    Update Image
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- تحديث بيانات البروفايل -->
            <div class="p-4 sm:p-8 bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl mx-auto">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- تحديث كلمة المرور -->
            <div class="p-4 sm:p-8 bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl mx-auto">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- حذف الحساب -->
            <div class="p-4 sm:p-8 bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl mx-auto">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript لمعاينة الصورة الجديدة قبل الرفع -->
    <script>
        document.getElementById('imageInput').addEventListener('change', function(event) {
            let reader = new FileReader();
            reader.onload = function() {
                let img = document.getElementById('userImage');
                img.src = reader.result; // تحديث الصورة مباشرة بالمعاينة الجديدة
            }
            reader.readAsDataURL(event.target.files[0]); // قراءة الملف وعرضه
        });
    </script>

</x-app-layout>
