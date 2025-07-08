<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        {{-- UPDATED: Profile Photo Section --}}
        <div>
            <x-input-label for="photo" :value="__('Photo')" />
            <div class="mt-2 flex items-center">
                <div class="relative group">
                    {{-- Display existing photo or initials --}}
                    <img id="photo-preview" class="rounded-full h-20 w-20 object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
                    
                    {{-- Hover overlay with camera icon --}}
                    <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                        <label for="photo" class="cursor-pointer text-white">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </label>
                    </div>
                </div>
                {{-- Hidden file input --}}
                <input type="file" name="photo" id="photo" class="hidden" onchange="previewPhoto(event)">
            </div>
             <x-input-error :messages="$errors->get('photo')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">{{ __('Click here to re-send the verification email.') }}</button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">{{ __('A new verification link has been sent to your email address.') }}</p>
                    @endif
                </div>
            @endif
        </div>

        <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone Number')" />
            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $user->phone)" autocomplete="tel" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        {{-- Student Verification Section (Unchanged) --}}
        @if(!Auth::user()->isAdmin())
            <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Student Verification</h3>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    If you are a current student, please enter your official Student ID, Promotion, and Group to request access to your personal schedule.
                </p>
                <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <x-input-label for="student_id" :value="__('Official Student ID')" />
                        <x-text-input id="student_id" name="student_id" type="text" class="mt-1 block w-full" :value="old('student_id', $user->student_id)" />
                        <x-input-error :messages="$errors->get('student_id')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="promotion_name" :value="__('Promotion')" />
                        <x-text-input id="promotion_name" name="promotion_name" type="text" class="mt-1 block w-full" :value="old('promotion_name', $user->promotion_name)" placeholder="e.g., 30" />
                        <x-input-error :messages="$errors->get('promotion_name')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="group_name" :value="__('Group')" />
                        <x-text-input id="group_name" name="group_name" type="text" class="mt-1 block w-full" :value="old('group_name', $user->group_name)" placeholder="e.g., 33+45" />
                        <x-input-error :messages="$errors->get('group_name')" class="mt-2" />
                    </div>
                </div>
            </div>
        @endif
        
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>

    {{-- Script to handle live photo preview --}}
    <script>
        function previewPhoto(event) {
            const reader = new FileReader();
            reader.onload = function(){
                const output = document.getElementById('photo-preview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</section>