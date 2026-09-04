<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Masuk - Sistem Pengurusan Jadual</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-900 h-screen flex items-center justify-center">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">
        <div class="text-center mb-6">
            <div class="inline-flex p-3 bg-indigo-100 text-indigo-600 rounded-xl mb-3">
                <i class="fa-solid fa-calendar-days text-3xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Log Masuk Sistem</h2>
            <p class="text-sm text-gray-500">Sila masukkan maklumat akaun anda</p>
        </div>

        @if($errors->any())
            <div class="bg-red-50 text-red-600 p-3 rounded-lg text-sm mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Username / ID</label>
                <input type="text" name="username" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none" placeholder="admin / lect1 / stud1">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kata Laluan</label>
                <input type="password" name="password" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none" placeholder="••••••••">
            </div>

            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 rounded-lg transition">
                Log Masuk
            </button>
        </form>

        <div class="mt-6 border-t pt-4 text-xs text-center text-gray-400">
            Testing Credentials: <br>
            <span class="font-bold">admin / 123</span> | 
            <span class="font-bold">lect1 / lect1</span> | 
            <span class="font-bold">stud1 / stud1</span>
        </div>
    </div>

</body>
</html>