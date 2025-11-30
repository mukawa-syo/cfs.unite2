@extends('layouts.guest')

@section('content')
<div class="mb-4 text-sm text-gray-600">
    パスワードをお忘れの方は、メールアドレスを入力してください。<br>
    パスワードリセット用のリンクをメールでお送りします。
</div>

<!-- Session Status -->
<x-auth-session-status class="mb-4" :status="session('status')" />

<!-- Validation Errors -->
<x-auth-validation-errors class="mb-4" :errors="$errors" />

<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <!-- Email Address -->
    <div class="mb-3">
        <x-label for="email" value="メールアドレス" />
        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
    </div>

    <div class="d-grid gap-2">
        <x-button>
            パスワードリセットリンクを送信
        </x-button>
        <a href="{{ route('login') }}" class="btn btn-link">
            ログインページに戻る
        </a>
    </div>
</form>
@endsection

        </x-button>
        <a href="{{ route('login') }}" class="btn btn-link">
            ログインページに戻る
        </a>
    </div>
</form>
@endsection

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

        </x-button>
        <a href="{{ route('login') }}" class="btn btn-link">
            ログインページに戻る
        </a>
    </div>
</form>
@endsection

        </x-button>
        <a href="{{ route('login') }}" class="btn btn-link">
            ログインページに戻る
        </a>
    </div>
</form>
@endsection

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

        </x-button>
        <a href="{{ route('login') }}" class="btn btn-link">
            ログインページに戻る
        </a>
    </div>
</form>
@endsection

        </x-button>
        <a href="{{ route('login') }}" class="btn btn-link">
            ログインページに戻る
        </a>
    </div>
</form>
@endsection

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
