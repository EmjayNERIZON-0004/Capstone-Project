<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Office Login - SDO San Carlos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body { 
            background: linear-gradient(to right,rgb(218, 2rgb(4, 4, 4) 177, 177));

            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: 'Poppins', sans-serif;
        }
        .login-container {
            background: #343a40;

            backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 15px;
            text-align: center;
            max-width: 400px;
            width: 100%;
            color: white;
        }
        .btn-custom {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="login-container">
    <img src="{{ asset('logo.png') }}" alt="Logo" class="mb-3" style="width: 100px;">
    
    <h3 class="mb-3">Login to  SDO San Carlos </h3>
    <p class="mb-4">Select your office and enter the passcode:</p>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.login') }}" method="POST">
            @csrf
             
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
              
        </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
