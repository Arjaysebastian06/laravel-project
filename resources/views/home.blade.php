<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .requirements {
            font-size: 0.9rem;
            display: none;
            /* initially hidden */
            margin-top: 5px;
        }

        .requirements span {
            display: flex;
            align-items: center;
            color: red;
        }

        .requirements span.valid {
            color: green;
        }

        .requirements span i {
            margin-right: 5px;
        }

        a {
            text-decoration: none;
        }

        #captcha-image img {
            width: 180px;
            /* adjust width */
            height: 60px;
            /* adjust height */
            object-fit: cover;
            border: 1px solid #ccc;
            /* optional border */
            border-radius: 5px;
            justify-content: center;
        }

        #required {
            color: red;
        }
    </style>
</head>

<body class="bg-light">

    <div class="container d-flex justify-content-center align-items-center vh100">
        <div class="card shadow-lg p-4 mt-5" style="width: 400px;">
            <h3 class="card-title text-center mb-4">Registration Page</h3>
            <form action="{{ url('/') }}" method="POST">
                @csrf

                <!-- Full Name -->
                <div class="mb-2">
                    <label for="fullname" class="form-label">Full Name<span id="required">*</span></label>
                    <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Enter your full name" value="{{ old('fullname') }}">
                    @error('fullname')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address<span id="required">*</span></label>
                    <input type="text" class="form-control" name="email_address" id="email" placeholder="Enter your email" value="{{ old('email_address') }}">
                    
                    @error('email_address')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Date of Birth -->
                <div class="mb-3">
                    <label for="dob" class="form-label">Date of Birth<span id="required">*</span></label>
                    <input type="date" class="form-control" name="date_of_birth" id="dob" value="{{ old('date_of_birth') }}">
                    @error('date_of_birth')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3 position-relative">
                    <label for="password" class="form-label">Password<span id="required">*</span></label>
                    <div class="input-group">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
                        <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                            <i class="bi bi-eye"></i>
                        </span>
                    </div>
                    @error('password')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror

                    <!-- Password Requirements -->
                    <div class="requirements mt-2" id="passwordRequirements">
                        <span id="length"><i class="bi bi-x-circle"></i> Minimum 8 characters</span>
                        <span id="uppercase"><i class="bi bi-x-circle"></i> At least 1 uppercase letter</span>
                        <span id="number"><i class="bi bi-x-circle"></i> At least 1 number</span>
                        <span id="special"><i class="bi bi-x-circle"></i> At least 1 special character (!@#$%^&*)</span>
                    </div>
                </div>

                <!-- Confirm Password -->
                <div class="mb-3 position-relative">
                    <label for="confirmPassword" class="form-label"></span> Confirm Password<span id="required">*</span></label>
                    <div class="input-group">
                        <input type="password" class="form-control" name="password_confirmation" id="confirmPassword" placeholder="Confirm password">
                        <span class="input-group-text" id="toggleConfirmPassword" style="cursor: pointer;">
                            <i class="bi bi-eye"></i>
                        </span>
                    </div>
                </div>

                <!-- Captcha -->
                <div class="mb-3 position-relative">
                    <label for="captcha" class="form-label">Captcha<span id="required">*</span></label>
                    <small class="text-muted d-block mb-2">
                        Please solve the simple math problem below and enter the answer in the box.
                    </small>

                    <div class="d-flex mb-2 justify-content-center align-items-center">
                        <span id="captcha-image">{!! captcha_img('math') !!}</span>
                        <button type="button" class="btn btn-secondary btn-sm ms-2" id="reload">↻</button>
                    </div>

                    <input type="text" name="captcha" class="form-control" placeholder="Enter your answer here">
                    @error('captcha')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>

                <p class="text-center mt-3">
                    Already have an account? <a href="{{ url('/login') }}">Login here</a>
                </p>
            </form>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
        const confirmPassword = document.getElementById('confirmPassword');
        const passwordRequirements = document.getElementById('passwordRequirements');
        const lengthReq = document.getElementById('length');
        const upperReq = document.getElementById('uppercase');
        const numberReq = document.getElementById('number');
        const specialReq = document.getElementById('special');

        // Show/hide password
        togglePassword.addEventListener('click', () => {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            togglePassword.innerHTML = type === 'password' ? '<i class="bi bi-eye"></i>' : '<i class="bi bi-eye-slash"></i>';
        });
        toggleConfirmPassword.addEventListener('click', () => {
            const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPassword.setAttribute('type', type);
            toggleConfirmPassword.innerHTML = type === 'password' ? '<i class="bi bi-eye"></i>' : '<i class="bi bi-eye-slash"></i>';
        });

        // Show password requirements on focus
        password.addEventListener('focus', () => {
            passwordRequirements.style.display = 'block';
        });
        // Hide password requirements on blur if field is empty
        password.addEventListener('blur', () => {
            if (password.value === '') {
                passwordRequirements.style.display = 'none';
            }
        });

        // Live validation
        password.addEventListener('input', () => {
            const val = password.value;

            lengthReq.classList.toggle('valid', val.length >= 8);
            lengthReq.querySelector('i').className = val.length >= 8 ? 'bi bi-check-circle' : 'bi bi-x-circle';

            upperReq.classList.toggle('valid', /[A-Z]/.test(val));
            upperReq.querySelector('i').className = /[A-Z]/.test(val) ? 'bi bi-check-circle' : 'bi bi-x-circle';

            numberReq.classList.toggle('valid', /[0-9]/.test(val));
            numberReq.querySelector('i').className = /[0-9]/.test(val) ? 'bi bi-check-circle' : 'bi bi-x-circle';

            specialReq.classList.toggle('valid', /[!@#$%^&*]/.test(val));
            specialReq.querySelector('i').className = /[!@#$%^&*]/.test(val) ? 'bi bi-check-circle' : 'bi bi-x-circle';
        });

        // Confirm password validation
        const form = document.querySelector('form');
        form.addEventListener('submit', (e) => {
            if (password.value !== confirmPassword.value) {
                e.preventDefault();
                alert('Passwords do not match!');
            }
        });


        document.getElementById('reload').addEventListener('click', function() {
            fetch('/reload-captcha')
                .then(response => response.text())
                .then(data => document.getElementById('captcha-image').innerHTML = data);
        });
    </script>

</body>

</html>