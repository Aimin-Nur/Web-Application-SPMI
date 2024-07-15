<div class="container-fluid">
    <div class="col-lg-12">
        <form method="post" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')
            <div class="mt-3">
                <label for="name" class="form-label">{{ __('Name') }}</label>
                <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $name) }}" required autofocus autocomplete="name">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $email) }}" required autocomplete="username">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @if ($email instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $email->hasVerifiedEmail())
                    <div class="mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification" type="submit" class="btn btn-link">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 text-success">{{ __('A new verification link has been sent to your email address.') }}</p>
                        @endif
                    </div>
                @endif
            </div>

            <div>
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                @if (session('status') === 'profile-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-success">{{ __('Saved.') }}</p>
                @endif
            </div>
        </form>
    </div>
</div>
