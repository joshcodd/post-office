<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700;1,800&family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <title>PostOffice🏣 - @yield('title')</title>
</head>

<body class="font-sans antialiased">
    <nav class="bg-white shadow-lg sticky top-0">
        <div class="flex px-4">
            <div class="container mx-auto md:flex p-3 items-center">
                <div href="#" id="title" class="flex py-4 px-2 font-garamond text-2xl">
                    PostOffice🏣
                </div>
                <div class="hidden md:flex  font-light text-md md:ml-auto">
                    <div
                        class="hoverSplitContainer font-nunito m-50-important
                    {{ request()->is('posts') ? 'active' : '' }}">
                        <a href="" class="topHalf font-nunito">Home</a>
                        <a href="" class="bottomHalf font-nunito">Home</a>
                    </div>

                    <div class="hoverSplitContainer font-nunito m-50-important">
                        <a href="" class="topHalf font-nunito">Notifications</a>
                        <a href="" class="bottomHalf font-nunito">Notifications</a>
                    </div>

                    <div class="hoverSplitContainer font-nunito m-50-important">
                        <a href="" class="topHalf font-nunito">New Post</a>
                        <a href="" class="bottomHalf font-nunito">New Post</a>
                    </div>

                    <div class="hoverSplitContainer font-nunito m-50-important">
                        <a href="" class="topHalf font-nunito">Profile</a>
                        <a href="" class="bottomHalf font-nunito">Profile</a>
                    </div>
                </div>
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
            <div
                class="hoverSplitContainer font-nunito hover:bg-spotify text-sm px-7 py-5 
                        {{ request()->is('posts') ? 'active' : '' }}">
                <a href="" class="topHalf font-nunito">Home</a>
                <a href="" class="bottomHalf font-nunito">Home</a>
            </div>

            <div class="hoverSplitContainer font-nunito hover:bg-spotify text-sm px-7 py-5">
                <a href="" class="topHalf font-nunito">Notifications</a>
                <a href="" class="bottomHalf font-nunito">Notifications</a>
            </div>

            <div class="hoverSplitContainer font-nunito hover:bg-spotify text-sm px-7 py-5">
                <a href="" class="topHalf font-nunito">New Post</a>
                <a href="" class="bottomHalf font-nunito">New Post</a>
            </div>

            <div class="hoverSplitContainer font-nunito hover:bg-spotify text-sm px-7 py-5">
                <a href="" class="topHalf font-nunito">Profile</a>
                <a href="" class="bottomHalf font-nunito">Profile</a>
            </div>
        </div>
        <script type="application/javascript">
            const ham_burger = document.querySelector("button.ham-burger");
            const mobile_menu = document.querySelector(".mobile-menu");

            ham_burger.addEventListener("click", () => {
                mobile_menu.classList.toggle("hidden");
            });
        </script>
    </nav>

    <div class="min-h-screen" id="root">
        <div>
            @yield('content')
        </div>

    </div>
</body>

<script type="application/javascript">
    const title = document.querySelector("#title");
    const titles = [
        "postoffice",
        "postOffice",
        "Yūbinkyoku",
        "yūBiNkyOku",
        "pOStOffic3",
        "postoffice",
        "PostOffice",
    ]

    let date = new Date();
    let previous_time;
    let current_time;
    const glitch_length = 2000;
    const pause_length = 10000;
    glitchTitle();
    setInterval(glitchTitle, glitch_length + pause_length);

    function glitchTitle() {
        date = new Date();
        previous_time = date.getTime();

        let intervalID = setInterval(() => {
            const random = Math.floor(Math.random() * ((titles.length - 1) - 0 + 1) + 0);
            title.innerHTML = titles[random];

            date = new Date();
            current_time = date.getTime();
            if ((current_time - previous_time) > glitch_length) {
                clearInterval(intervalID);
                title.innerHTML = "PostOffice🏣";
            }
        }, 50 + Math.random() * 150);
    }
</script>

<script type="application/javascript">
    let app = new Vue({
        el: "#root",
        data: {
            commentList: [],
            commentContentText: '',
        },

        mounted() {
            axios.get("{{ route('api.comments.index') }}").then(response => {
                this.commentList = [];
                for (let i = 0; i < response.data.length; i++) {
                    const current_post_id = response.data[i].post_id;
                    if (this.commentList[current_post_id] == undefined) {
                        this.commentList[current_post_id] = response.data.filter(function(comment) {
                            return comment.post_id === current_post_id;
                        })
                    }
                }
            }).catch(response => {
                console.log(response);
            })
        },

        methods: {
            addComment: function(post_id) {
                axios.post("{{ route('api.comments.store') }}", {
                    user_id: 1, //TODO
                    post_id: post_id,
                    content: this.commentContentText,
                }).then(response => {
                    this.commentList[response.data.post_id].push(response.data);
                    this.commentContentText = "";
                }).catch(response => {
                    console.log(response);
                })
            },
        }
    });
</script>

</html>
