<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            overflow-x: hidden;
            background-color: #f8f9fa;
        }

        /* Sidebar */
        .sidebar {
            height: 100vh;
            background-color: #343a40;
            color: #fff;
            padding-top: 1rem;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 0.75rem 1.25rem;
            transition: background 0.3s;
        }

        .sidebar a:hover {
            background-color: #495057;
            border-radius: 5px;
        }

        /* Main content */
        .main-content {
            padding: 2rem;
        }

        /* Navbar */
        .navbar {
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Cards */
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }

        #required {
            color: red;
        }
    </style>
</head>

<body>

    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar flex-shrink-0 p-3">
            <h4 class="text-center mb-4">My Dashboard</h4>
            <a href="#"><i class="bi bi-speedometer2 me-2"></i> Overview</a>
            <a href="#"><i class="bi bi-person-circle me-2"></i> Profile</a>
            <a href="#"><i class="bi bi-gear me-2"></i> Settings</a>

            <a href="{{ url('/logout') }}"
                onclick="event.preventDefault(); 
            if(confirm('Are you sure you want to logout?')) { 
                document.getElementById('logout-form').submit(); 
            }">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
            </a>

            <!-- Hidden logout form -->
            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                @csrf
            </form>


        </div>

        <!-- Main Content -->
        <div class="flex-grow-1">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light px-4">
                <div class="container-fluid">
                    <span class="navbar-brand mb-0 h1">Dashboard</span>
                    <div class="d-flex">
                        <span class="me-3">Welcome, <span class="me-3 text-uppercase">{{ Auth::user()->fullname ?? 'User' }} </span></span>
                    </div>
                </div>
            </nav>

            <!-- Dashboard Content -->

            <div class="container py-5">
                <!-- User Alert -->
                @if (session('success'))
                <div id="userAlert" class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if (session('info'))
                <div id="userAlert" class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ session('info') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if (session('error'))
                <div id="userAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if ($errors->any())
                <div id="userAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif


                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="fw-bold">User Management</h3>
                    <!-- Add User Button -->
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addUserModal">
                        <i class="bi bi-plus-circle"></i> Create
                    </button>

                </div>

                <div class="card shadow-sm">
                    <div class="card-body ">
                        <table id="example" class="table table-hover table-bordered nowrap" style="width:100%">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Full Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Date of Birth</th>
                                    <th scope="col" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $index => $user)
                                <tr>
                                    <th scope="row">{{ $index + 1 }}</th>
                                    <td>{{ $user->fullname }}</td>
                                    <td>{{ $user->email_address }}</td>
                                    <td>{{ $user->date_of_birth }}</td>
                                    <td class="text-center">

                                        <!-- View Button -->
                                        <button type="button" class="btn btn-secondary btn-sm me-1"
                                            data-bs-toggle="modal"
                                            data-bs-target="#userModal-{{ $user->id }}">
                                            <i class="bi bi-eye"></i>
                                        </button>

                                        <!-- Edit Button -->
                                        <button type="button" class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $user->id }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>


                                        <!-- Delete Button -->
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Add User Modal -->
                                <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('users.store') }}" method="POST">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <!-- Full Name -->
                                                    <div class="mb-3">
                                                        <label for="fullname" class="form-label"><span id="required">*</span>Full Name</label>
                                                        <input type="text" name="fullname" class="form-control" value="{{ old('fullname') }}">
                                                        @error('fullname')
                                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <!-- Email Address -->
                                                    <div class="mb-3">
                                                        <label for="email_address" class="form-label"><span id="required">*</span>Email Address</label>
                                                        <input type="email" name="email_address" class="form-control" value="{{ old('email_address') }}">
                                                        @error('email_address')
                                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <!-- Date of Birth -->
                                                    <div class="mb-3">
                                                        <label for="date_of_birth" class="form-label"><span id="required">*</span>Date of Birth</label>
                                                        <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}">
                                                        @error('date_of_birth')
                                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <!-- Password -->
                                                    <div class="mb-3 position-relative">
                                                        <label for="password" class="form-label"><span id="required">*</span> Password</label>
                                                        <div class="input-group">
                                                            <input type="password" class="form-control" name="password" id="passwordField" placeholder="Enter password">
                                                            <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                                                <i class="bi bi-eye"></i>
                                                            </span>
                                                        </div>
                                                        @error('password')
                                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                                        @enderror

                                                        <!-- Password Requirements -->
                                                        <div class="requirements mt-2" id="passwordRequirements" style="display:none; font-size: 0.9rem;">
                                                            <span id="length"><i class="bi bi-x-circle text-danger"></i> Minimum 8 characters</span><br>
                                                            <span id="uppercase"><i class="bi bi-x-circle text-danger"></i> At least 1 uppercase letter</span><br>
                                                            <span id="number"><i class="bi bi-x-circle text-danger"></i> At least 1 number</span><br>
                                                            <span id="special"><i class="bi bi-x-circle text-danger"></i> At least 1 special character (!@#$%^&*)</span>
                                                        </div>
                                                    </div>

                                                    <!-- Confirm Password -->
                                                    <div class="mb-3 position-relative">
                                                        <label for="confirmPassword" class="form-label"><span id="required">*</span> Confirm Password</label>
                                                        <div class="input-group">
                                                            <input type="password" class="form-control" name="password_confirmation" id="confirmPassword" placeholder="Confirm password">
                                                            <span class="input-group-text" id="toggleConfirmPassword" style="cursor: pointer;">
                                                                <i class="bi bi-eye"></i>
                                                            </span>
                                                        </div>
                                                        @error('password_confirmation')
                                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Add User</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                <!-- Modal Read -->
                                <div class="modal fade" id="userModal-{{ $user->id }}" tabindex="-1" aria-labelledby="userModalLabel-{{ $user->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="userModalLabel-{{ $user->id }}">User Details</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Full Name:</strong> {{ $user->fullname }}</p>
                                                <p><strong>Email:</strong> {{ $user->email_address }}</p>
                                                <p><strong>Date of Birth:</strong> {{ $user->date_of_birth }}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Edit User Modal -->
                                <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="editUserModalLabel{{ $user->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('users.update', $user->id) }}" method="POST">
                                                @csrf
                                                @method('PUT') <!-- Required for Laravel PUT method -->

                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editUserModalLabel{{ $user->id }}">Edit User</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">

                                                    <div class="mb-3">
                                                        <label for="fullname{{ $user->id }}" class="form-label"><span id="required">*</span>Full Name</label>
                                                        <input type="text" class="form-control" id="fullname{{ $user->id }}" name="fullname" value="{{ $user->fullname }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email{{ $user->id }}" class="form-label"><span id="required">*</span>Email</label>
                                                        <input type="text" class="form-control" id="email{{ $user->id }}" name="email_address" value="{{ $user->email_address }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="dob{{ $user->id }}" class="form-label"><span id="required">*</span>Date of Birth</label>
                                                        <input type="date" class="form-control" id="dob{{ $user->id }}" name="date_of_birth" value="{{ $user->date_of_birth }}">
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-warning">Save Changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">No users found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination -->
                <!-- <nav class="mt-3">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#">Previous</a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="#">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">3</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav> -->
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                responsive: true,
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                lengthMenu: [5, 10, 25, 50, 100],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search..."
                }
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            const password = document.getElementById('passwordField');
            const confirmPassword = document.getElementById('confirmPassword');
            const togglePassword = document.getElementById('togglePassword');
            const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
            const passwordRequirements = document.getElementById('passwordRequirements');
            const lengthReq = document.getElementById('length');
            const upperReq = document.getElementById('uppercase');
            const numberReq = document.getElementById('number');
            const specialReq = document.getElementById('special');

            // Toggle password visibility
            togglePassword.addEventListener('click', () => {
                const type = password.type === 'password' ? 'text' : 'password';
                password.type = type;
                togglePassword.innerHTML = type === 'password' ?
                    '<i class="bi bi-eye"></i>' :
                    '<i class="bi bi-eye-slash"></i>';
            });

            toggleConfirmPassword.addEventListener('click', () => {
                const type = confirmPassword.type === 'password' ? 'text' : 'password';
                confirmPassword.type = type;
                toggleConfirmPassword.innerHTML = type === 'password' ?
                    '<i class="bi bi-eye"></i>' :
                    '<i class="bi bi-eye-slash"></i>';
            });

            // Show requirements when password is focused
            password.addEventListener('focus', () => {
                passwordRequirements.style.display = 'block';
            });

            password.addEventListener('blur', () => {
                if (password.value.trim() === '') {
                    passwordRequirements.style.display = 'none';
                }
            });

            // Live check
            password.addEventListener('input', () => {
                const val = password.value;

                // Check length
                updateRequirement(lengthReq, val.length >= 8);
                // Uppercase
                updateRequirement(upperReq, /[A-Z]/.test(val));
                // Number
                updateRequirement(numberReq, /[0-9]/.test(val));
                // Special char
                updateRequirement(specialReq, /[!@#$%^&*]/.test(val));
            });

            function updateRequirement(element, condition) {
                const icon = element.querySelector('i');
                if (condition) {
                    icon.className = 'bi bi-check-circle text-success';
                } else {
                    icon.className = 'bi bi-x-circle text-danger';
                }
            }

            // Confirm password validation on submit
            const form = document.querySelector('form');
            form.addEventListener('submit', (e) => {
                if (password.value !== confirmPassword.value) {
                    e.preventDefault();
                    alert('Passwords do not match!');
                }
            });
        });

        // Auto hide alert after 3 seconds
        setTimeout(function() {
            var alert = document.getElementById('userAlert');
            if (alert) {
                var bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
                bsAlert.close();
            }
        }, 3000); // 3000ms = 3 seconds

        document.getElementById('reload').addEventListener('click', function() {
            fetch('/reload-captcha') // create this route in Laravel
                .then(response => response.text())
                .then(data => {
                    document.getElementById('captcha-image').innerHTML = data;
                });
        });
    </script>

</body>

</html>