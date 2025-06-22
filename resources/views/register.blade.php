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
        input[type="text"],
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
    </style>
</head>
<body>
<form action="{{ route('register') }}" method="POST">
    @csrf

    @error('name')
    <div class="alert alert-fail">
        <p>{{ $message }}</p>
    </div>
    @enderror

    @error('email')
    <div class="alert alert-fail">
        <p>{{ $message }}</p>
    </div>
    @enderror

    @error('password')
    <div class="alert alert-fail">
        <p>{{ $message }}</p>
    </div>
    @enderror

    <h2>ثبت ‌نام</h2>

    <label for="email">اسم</label>
    <input type="text" name="name" id="name" required>

    <label for="email">ایمیل</label>
    <input type="email" name="email" id="email" required>

    <label for="password">رمز عبور</label>
    <input type="password" name="password" id="password" required>

    <label for="password">تکرار رمز عبور</label>
    <input type="password" name="password_confirmation" id="password_confirmation" required>

    <button type="submit">ثبت ‌نام</button>
</form>
</body>
</html>
