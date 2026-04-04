<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin — Dimas Toyota</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; }
  </style>
</head>
<body class="bg-slate-900 min-h-screen flex items-center justify-center p-4">

  <div class="w-full max-w-[26rem]">

    {{-- Card Container: Tanpa garis merah di atas --}}
    <div class="bg-slate-800 p-8 sm:p-10 rounded-3xl shadow-2xl border border-slate-700/50">

      {{-- Header & Logo --}}
      <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-14 h-14 bg-red-600 rounded-2xl mb-4 shadow-lg shadow-red-600/20">
          <span class="text-white font-bold text-2xl">T</span>
        </div>
        <h1 class="font-bold text-2xl text-slate-100 tracking-tight">Dimas Toyota</h1>
        <p class="text-slate-400 text-sm mt-1 font-medium">Panel Admin Jember</p>
      </div>

      @if($errors->any())
      <div class="mb-6 bg-red-500/10 border border-red-500/20 rounded-xl px-4 py-3 text-sm text-red-400 flex items-start gap-3">
        <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
        <span>{{ $errors->first() }}</span>
      </div>
      @endif

      <form method="POST" action="{{ route('login.post') }}">
        @csrf

        {{-- Input Email --}}
        <div class="mb-5">
          <label class="block text-sm font-semibold text-slate-300 mb-2">
            Alamat Email
          </label>
          <div class="relative group">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500 group-focus-within:text-red-500 transition-colors">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            </div>
            <input type="email" name="email" required autofocus
                   value="{{ old('email') }}"
                   placeholder="admin@ramatoyota.com"
                   class="w-full bg-slate-900/50 border border-slate-700 text-slate-100 rounded-xl pl-10 pr-4 py-3 text-sm
                          focus:outline-none focus:bg-slate-900 focus:border-red-500 focus:ring-4 focus:ring-red-500/10 
                          transition-all placeholder-slate-500">
          </div>
        </div>

        {{-- Input Password --}}
        <div class="mb-6">
          <label class="block text-sm font-semibold text-slate-300 mb-2">
            Password
          </label>
          <div class="relative group">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500 group-focus-within:text-red-500 transition-colors">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
            </div>
            <input type="password" name="password" required
                   placeholder="••••••••"
                   class="w-full bg-slate-900/50 border border-slate-700 text-slate-100 rounded-xl pl-10 pr-4 py-3 text-sm
                          focus:outline-none focus:bg-slate-900 focus:border-red-500 focus:ring-4 focus:ring-red-500/10 
                          transition-all placeholder-slate-500">
          </div>
        </div>

        {{-- Remember Me --}}
        <div class="flex items-center justify-between mb-8">
          <label class="flex items-center gap-2.5 cursor-pointer group">
            <input type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-600 bg-slate-900 text-red-600 focus:ring-red-500/20 cursor-pointer accent-red-600">
            <span class="text-sm font-medium text-slate-400 group-hover:text-slate-200 transition-colors">Ingat saya di perangkat ini</span>
          </label>
        </div>

        {{-- Submit Button --}}
        <button type="submit"
                class="w-full bg-red-600 text-white font-semibold text-sm rounded-xl py-3.5 
                       hover:bg-red-700 hover:shadow-lg hover:shadow-red-600/20 
                       active:scale-[0.98] transition-all duration-200">
          Masuk ke Dashboard
        </button>
      </form>
    </div>

    {{-- Back Link --}}
    <div class="text-center mt-6">
      <a href="{{ route('home') }}"
         class="inline-flex items-center gap-1.5 text-slate-400 text-sm font-medium hover:text-slate-200 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Halaman Utama
      </a>
    </div>

  </div>

</body>
</html>