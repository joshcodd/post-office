@props(['id' => 'an_id', 'route' => ''])

<div id={{ $id }} class="fixed left-0 right-0 top-0 bottom-0 hidden h-full w-full bg-white z-50 bg-opacity-70">
    <div
        class="fixed left-1/2 transform -translate-x-1/2 top-1/2 transform -translate-y-1/2 rounded-2xl shadow-md overflow-hidden p-7 text-center bg-white opacity-100">

        <div class="block pb-3">
            Are you sure?
        </div>

        <button
            class="mr-4 rounded-full px-3.5 py-1 text-sm font-semibold border text-black border-black  hover:bg-black hover:text-white "
            onclick="toggleHidden({{ $id }})">Cancel
        </button>

        <form action={{ $route }} method="POST" class="inline-block">
            @csrf
            @method("DELETE")
            <button type="submit" value="submit"
                class="rounded-full px-3.5 py-1 text-sm font-semibold border text-spotify border-spotify hover:bg-spotify hover:text-white">Delete
            </button>
        </form>
    </div>
</div>
