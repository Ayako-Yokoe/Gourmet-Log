<div class="w-1/6 h-screen bg-teal-400">
    <nav class="flex flex-col h-full text-white text-center">
        <a href="/dashboard" class="px-4 pt-6 pb-10">
            <span class="text-lg">Gourmet Log</span>
        </a>
        <ul>
            <li class="py-2 border-t-2 border-b-2 border-white">
                MENU
            </li>
            <li class="py-6 {{ request()->is('restaurants') ? 'bg-white text-amber-950 border-t-2 border-teal-400' : '' }}">
                <a href="/restaurants">
                    お店リスト
                </a>
            </li>
            <li class="py-6 {{ request()->is('restaurants/create') ? 'bg-white text-amber-950' : '' }}">
                <a href="/restaurants/create">
                    お店登録/編集
                </a>
            </li>
            <li class="py-6 {{ request()->is('categories') ? 'bg-white text-amber-950' : '' }}">
                <a href="/categories">
                    カテゴリー管理
                </a>
            </li>
        </ul>
        <div class="mt-auto py-6">
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="cursor-pointer hover:text-teal-700">
                    {{ $userName }}
                </button>
            </form>
        </div>
    </nav>
</div>



{{-- 
    <a> : href => route
    <form> : @csrf + method=POST, action='/logout'

    class: add hover, font size 
    active: bg-white

--}}
