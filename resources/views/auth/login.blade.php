<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login Admin</title>
   <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen flex items-center justify-center p-4">
   <div class="w-full max-w-md">
      <form method="POST" action="{{ route('login') }}" class="bg-white rounded-2xl shadow-lg p-8">
         @csrf

         <h1 class="text-2xl font-bold text-center text-slate-800 mb-6">🔐 Login Admin</h1>

         @if(session('error'))
            <div class="bg-yellow-100 text-yellow-800 px-4 py-3 rounded-lg mb-4 text-sm border border-yellow-300">
               ⚠️ {{ session('error') }}
            </div>
         @endif

         <label for="" class="block text-sm font-medium text-slate-700 mb-1">Email</label>
         
         {{-- <input type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full border border-slate-300 rounded-lg px-4 py-2 mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500"> --}}
         
         <input type="email" name="email" required autofocus class="w-full border border-slate-300 rounded-lg px-4 py-2 mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500" value="admin@digitalprinting.com">

         <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
         <input type="password" name="password" required class="w-full border border-slate-300 rounded-lg px-4 py-2 mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500" value="password">

         <label class="flex items-center gap-2 text-sm text-slate-600 mb-6">
             <input type="checkbox" name="remember" class="rounded"> Ingat saya
         </label>

         <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg py-2.5 transition">
             Masuk
         </button>
      </form>

      <p class="text-center text-sm text-slate-500 mt-4">
         <a href="{{ route('home') }}" class="hover:underline">
            ← Kembali ke website
         </a>
     </p>
   </div>
</body>
</html>