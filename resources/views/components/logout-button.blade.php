<form method="POST" action="{{ route('logout') }}" class="w-full">
    @csrf
    <button type="submit"
        class="w-full flex items-center gap-2 px-4 py-2.5 text-xs font-semibold text-rose-600 bg-rose-50/50 hover:bg-rose-100/70 active:scale-[0.98] rounded-xl transition-all border border-rose-100">
        <i class="fa-solid fa-right-from-bracket text-sm"></i>
        <span>Logout</span>
    </button>
</form>
