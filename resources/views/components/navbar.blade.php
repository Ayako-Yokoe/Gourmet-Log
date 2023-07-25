<nav class="flex justify-between items-center bg-teal-400 text-white p-6 h-1/6">

    <a href="/" class="hover:text-teal-700 {{ request()->is('/') ? "invisible" : '' }}">
        <span class="text-3xl">Gourmet Log</span>
    </a>

    <ul class="flex text-lg space-x-8">

        <li>
            <a href="/login" class="hover:text-teal-700">
                ログイン
            </a>
        </li>

        <li>
            <a href="/register" class="hover:text-teal-700">
                新規登録
            </a>
        </li>
    </ul>
</nav>