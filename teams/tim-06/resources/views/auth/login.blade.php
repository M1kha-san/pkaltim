<x-guest-layout>
    <div class="text-center mb-4">
            <h4 class="fw-bold text-dark">Selamat Datang!</h4>
            <p class="text-muted small">Silakan login untuk mengakses dashboard admin.</p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="alert alert-success mb-3 small" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-envelope text-muted"></i></span>
                    <input type="email" class="form-control bg-light border-start-0 ps-0 text-muted" id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan Email Anda" required autofocus autocomplete="username" style="font-size: 0.9rem;">
                </div>
                <x-input-error :messages="$errors->get('email')" class="text-danger mt-1 small" />
            </div>

            <!-- Password -->
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-lock text-muted"></i></span>
                    <input type="password" class="form-control bg-light border-start-0 border-end-0 ps-0 text-muted" id="password" name="password" placeholder="Masukkan Password Anda" required autocomplete="current-password" style="font-size: 0.9rem;">
                    <span class="input-group-text bg-light border-start-0" role="button" onclick="togglePassword()">
                        <i class="fa-solid fa-eye text-muted" id="togglePasswordIcon"></i>
                    </span>
                </div>
                <x-input-error :messages="$errors->get('password')" class="text-danger mt-1 small" />
            </div>

            <div class="d-grid mb-4">
                <button type="submit" class="btn fw-bold py-2" style="background-color: #dfc848; color: #5a5a5a; border: none;">
                    {{ __('Masuk') }}
                </button>
            </div>
        </form>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const icon = document.getElementById('togglePasswordIcon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('bi-eye-fill');
                icon.classList.add('bi-eye-slash-fill');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('bi-eye-slash-fill');
                icon.classList.add('bi-eye-fill');
            }
        }
    </script>
</x-guest-layout>
