<div class="w-1/6 h-screen bg-teal-400">
    <nav class="flex flex-col h-full text-white text-center">
        <a href="/" class="px-4 pt-6 pb-10">
            <span class="text-lg">Gourmet Log</span>
        </a>
        <ul>
            <li class="py-2 border-t-2 border-b-2 border-white">MENU</li>
            <li class="py-6"><a href="/restaurants">Restaurant List</a></li>
            <li class="py-6"><a href="/restaurants/create">Create/Edit Restaurant</a></li>
            <li class="py-6"><a href="/categories">Manage Categoriesa</a></li>
        </ul>
        <div class="mt-auto py-6">
            <form>User</form>
        </div>
    </nav>
</div>



{{-- 
    <a> : href => route
    <form> : @csrf + method=POST, action='/logout'

    class: add hover, font size 
    active: bg-white

--}}
