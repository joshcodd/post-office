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
                        <div class=" topHalf">Home</div>
                        <div class="bottomHalf">Home</div>
                    </a>

                    <a class="hoverSplitContainer font-nunito m-50-important">
                        <div href="" class="topHalf">Notifications</div>
                        <div href="" class="bottomHalf font-nunito">Notifications</div>
                    </a>

                    <a class="hoverSplitContainer font-nunito m-50-important
                    {{ request()->is('posts/create') ? 'active' : '' }}"
                        href="{{ route('posts.create') }}">
                        <div href="" class="topHalf">New Post</div>
                        <div href="" class="bottomHalf">New Post</div>
                    </a>

                    <a class="hoverSplitContainer m-50-important {{ request()->is('users/me') ? 'active' : '' }}"
                        href="{{ route('users.show.me') }}">
                        <div href="" class="topHalf font-nunito">Profile</div>
                        <div href="" class="bottomHalf font-nunito">Profile</div>
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="hoverSplitContainer font-light font-nunito m-50-important">
                            <div href="" class="topHalf">Log Out</div>
                            <div href="" class="bottomHalf">Log Out</div>
                        </button>
                    </form>
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

        <a href="{{ route('posts.create') }}">
            <div
                class="hoverSplitContainer font-nunito hover:bg-spotify text-sm px-7 py-5 {{ request()->is('posts/create') ? 'active' : '' }}">
                <div class="topHalf font-nunito">New Post</div>
                <div class="bottomHalf font-nunito">New Post</div>
            </div>
        </a>

        <a href="">
            <div class="hoverSplitContainer font-nunito hover:bg-spotify text-sm px-7 py-5 {{ request()->is('users/me') ? 'active' : '' }}"
                href=" {{ route('users.show.me') }}">
                <div class="topHalf font-nunito">Profile</div>
                <div class="bottomHalf font-nunito">Profile</div>
            </div>
        </a>

        <form method="POST" action="{{ route('logout') }}" class="min-w-full">
            @csrf
            <button class="hoverSplitContainer font-nunito hover:bg-spotify text-sm px-7 py-5 min-w-full text-left">
                <div class="topHalf font-nunito">Log Out</div>
                <div class="bottomHalf font-nunito">Log Out</div>
            </button>
        </form>
    </div>
</nav>
