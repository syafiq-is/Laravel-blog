    <!-- Posts List -->
    <div class="vstack gap-3">
        @foreach ($posts as $post)
            <div class="border rounded p-4 d-flex justify-content-between">
                <div>
                    <div class="d-flex align-items-center">
                        <img class="rounded-circle object-fit-cover" src="/storage/{{ $post->user->profile_img }}"
                            style="width: 40px; height: 40px; outline: 1px solid gray" />
                        <a href="/profile/{{ $post->user_id }}" class="ms-2 hover-underline">
                            {{ $post->user->username }}
                        </a>
                        <span class="text-secondary mx-1">-</span>
                        <span class="text-secondary">{{ $post->created_at->format('M d, y') }}</span>
                    </div>

                    <h4 class="my-2 fw-bold">
                        <a href="/posts/{{ $post->id }}" class="text-brand hover-underline">
                            {{ $post->title }}
                        </a>
                    </h4>

                    <div
                        style="
            display: -webkit-box;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            -webkit-line-clamp: 2; /* Number of lines to show */
            ">
                        {{ $post->content }}
                    </div>

                    <div class="mt-4">
                        <a href="" class="px-2 py-1 rounded-pill bg-body-secondary"
                            style="width: fit-content; font-size: 0.8rem">
                            {{ $post->category->category }}
                        </a>
                    </div>
                </div>

                <div class="d-flex align-items-center ms-2">
                    <img src="/storage/{{ $post->cover_img }}" alt=""
                        style="aspect-ratio: 16/9; width: 200px; object-fit: cover" />
                </div>
            </div>
        @endforeach
    </div>
    <!-- End Posts List -->

    <!-- Pagination -->
    <nav id="pagination" class="mt-4 w-100 d-flex justify-content-center" style="">
        {{ $posts->links() }}
    </nav>
    <!-- End Pagination -->
