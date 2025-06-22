<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>فرم ثبت‌نام</title>
    <style>
        body {
            font-family: sans-serif;
            background: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        h2 {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 0.6rem;
            background: #3490dc;
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #2779bd;
        }

        .alert {
            position: relative;
            padding: 1rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: 0.375rem;
            font-size: 1rem;
        }

        .alert-success {
            color: #0f5132;
            background-color: #d1e7dd;
            border-color: #badbcc;
        }

        .alert-fail {
            color: #842029;
            background-color: #f8d7da;
            border-color: #f5c2c7;
        }

    </style>
</head>
<body>
<form action="{{ route('login') }}" method="POST">
    @csrf
    @if(session()->has('registered_successfully'))
        <div class="alert alert-success">
            <p>{{ session()->get('registered_successfully') }}</p>
        </div>
    @endif

    @error('password')
    <div class="alert alert-fail">
        <p>{{ $message }}</p>
    </div>
    @enderror

    @error('email')
    <div class="alert alert-fail">
        <p>{{ $message }}</p>
    </div>
    @enderror

    @if(session()->has('login_fail'))
        <div class="alert alert-fail">
            <p>{{ session()->get('login_fail') }}</p>
        </div>
    @endif

    <h2>ورود</h2>

    <label for="email">ایمیل</label>
    <input type="email" name="email" id="email" required>

    <label for="password">رمز عبور</label>
    <input type="password" name="password" id="password" required>

    <button type="submit">ورود</button>
</form>
</body>
</html>
