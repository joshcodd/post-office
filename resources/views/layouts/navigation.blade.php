<nav class="bg-white shadow-lg sticky top-0 z-10">
    <div class="flex px-4">
        <div class="container mx-auto md:flex p-3 items-center">
            <a href="{{ route('posts.index') }}" id="title" class="flex py-4 px-2 font-garamond text-2xl">
                PostOffice🏣
            </a>

            @auth
                <div class="hidden md:flex  font-light text-md md:ml-auto">
                    <a class="hoverSplitContainer font-nunito m-50-important
                {{ request()->is('posts') ? 'active' : '' }}"
                        href="{{ route('posts.index') }}">
                        <div class=" topHalf font-nunito">Home</div>
                        <div class="bottomHalf font-nunito">Home</div>
                    </a>

                    <a class="hoverSplitContainer font-nunito m-50-important">
                        <div href="" class="topHalf font-nunito">Notifications</div>
                        <div href="" class="bottomHalf font-nunito">Notifications</div>
                    </a>

                    <a class="hoverSplitContainer font-nunito m-50-important">
                        <div href="" class="topHalf font-nunito">New Post</div>
                        <div href="" class="bottomHalf font-nunito">New Post</div>
                    </a>

                    <a class="hoverSplitContainer font-nunito m-50-important">
                        <div href="" class="topHalf font-nunito">Profile</div>
                        <div href="" class="bottomHalf font-nunito">Profile</div>
                    </a>
                </div>
            @endauth
        </div>

        <!-- Ham burger menu button -->
        <div class="flex md:hidden">
            <button class="ham-burger">
                {{-- reference: https://codepen.io/duaneblake/pen/bGEgJZL --}}
                <svg x-show="!showMenu" class="w-7 h-7 text-gray-600 hover:text-spotify" fill="none"
                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </div>

    <div class="hidden mobile-menu">
        <a href="{{ route('posts.index') }}">
            <div
                class="hoverSplitContainer font-nunito hover:bg-spotify text-sm px-7 py-5 
                    {{ request()->is('posts') ? 'active' : '' }}">
                <div class="topHalf font-nunito">Home</div>
                <div class="bottomHalf font-nunito">Home</div>
            </div>
        </a>

        <a href="">
            <div class="hoverSplitContainer font-nunito hover:bg-spotify text-sm px-7 py-5">
                <div class="topHalf font-nunito">Notifications</div>
                <div class="bottomHalf font-nunito">Notifications</div>
            </div>
        </a>

        <a href="">
            <div class="hoverSplitContainer font-nunito hover:bg-spotify text-sm px-7 py-5">
                <div class="topHalf font-nunito">New Post</div>
                <div class="bottomHalf font-nunito">New Post</div>
            </div>
        </a>

        <a href="">
            <div class="hoverSplitContainer font-nunito hover:bg-spotify text-sm px-7 py-5">
                <div class="topHalf font-nunito">Profile</div>
                <div class="bottomHalf font-nunito">Profile</div>
            </div>
        </a>
    </div>
</nav>
