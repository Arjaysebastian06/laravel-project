<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .login-card {
            max-width: 400px;
            margin: 50px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            background-color: #fff;
        }

        .login-card h3 {
            margin-bottom: 20px;
        }

        a {
            text-decoration: none;
        }

        #required {
            color: red;
        }
    </style>
</head>

<body>

    <div class="login-card">
        <h3 class="text-center">Login</h3>
        @if(session('success'))
        <script>
            alert("{{ session('success') }}");
        </script>
        @endif

        @if ($errors->has('invalid'))
        <div id="loginAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $errors->first('invalid') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif


        <form action="{{ url('/login') }}" method="POST">
            @csrf

            <!-- Email Address -->
            <div class="mb-3">
                <label for="email" class="form-label"><span id="required">*</span> Email Address</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" value="{{ old('email') }}">
                @error('email')
                <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3 position-relative">
                <label for="password" class="form-label"><span id="required">*</span> Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                    <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                        <i class="bi bi-eye"></i>
                    </span>
                </div>
                @error('password')
                <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>

            <p class="text-center mt-3">
                Don't have an account? <a href="{{ url('/') }}">Register here</a>
            </p>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');

        togglePassword.addEventListener('click', () => {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            togglePassword.innerHTML = type === 'password' ? '<i class="bi bi-eye"></i>' : '<i class="bi bi-eye-slash"></i>';
        });

        // Auto close after 3 seconds
        setTimeout(() => {
            const alert = document.getElementById('loginAlert');
            if (alert) {
                const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
                bsAlert.close();
            }
        }, 3000); // 3000ms = 3 seconds
    </script>

</body>

</html>