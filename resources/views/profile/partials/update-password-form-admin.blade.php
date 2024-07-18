<section class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Update Password') }}
            </h2>
            <p class="mt-1 text-sm text-gray-600">
                {{ __('Ensure your account is using a long, random password to stay secure.') }}
            </p>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('password.update.admin', ['id' => $id]) }}">
                @csrf
                @method('put')

                <div class="form-group">
                    <label for="current_password">{{ __('Current Password') }}</label>
                    <input id="current_password" name="current_password" type="password" class="form-control" autocomplete="current-password">
                    @if($errors->updatePassword->get('current_password'))
                        <small class="text-danger">{{ $errors->updatePassword->get('current_password')[0] }}</small>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password">{{ __('New Password') }}</label>
                    <input id="password" name="password" type="password" class="form-control" autocomplete="new-password">
                    @if($errors->updatePassword->get('password'))
                        <small class="text-danger">{{ $errors->updatePassword->get('password')[0] }}</small>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password">
                    @if($errors->updatePassword->get('password_confirmation'))
                        <small class="text-danger">{{ $errors->updatePassword->get('password_confirmation')[0] }}</small>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    @if (session('status') === 'password-updated')
                        <p class="text-success mt-2">{{ __('Saved.') }}</p>
                    @endif
                </div>
            </form>
        </div>
    </div>
</section>
