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

        {{-- Profile Photo, Name, and Email fields remain the same --}}
        <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
            <input type="file" id="photo" class="hidden" x-ref="photo" x-on:change=" photoName = $refs.photo.files[0].name; const reader = new FileReader(); reader.onload = (e) => { photoPreview = e.target.result; }; reader.readAsDataURL($refs.photo.files[0]);" name="photo" />
            <x-input-label for="photo" :value="__('Photo')" />
            <div class="mt-2" x-show="! photoPreview">
                <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="rounded-full h-20 w-20 object-cover">
            </div>
            <div class="mt-2" x-show="photoPreview" style="display: none;">
                <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center" x-bind:style="'background-image: url(\'' + photoPreview + '\');'"></span>
            </div>
            <x-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.photo.click()">{{ __('Select A New Photo') }}</x-secondary-button>
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
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">{{ __('Saved.') }}</p>
                    @endif
                </div>
            @endif
        </div>
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone Number')" />
            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $user->phone)" autocomplete="tel" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        {{-- UPDATED: Added a check to hide this section for admins --}}
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
</section>