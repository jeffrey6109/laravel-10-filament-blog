<?php
    /** @var $posts \Illuminate\Pagination\LengthAwarePaginator */
?>

<x-app-layout meta-title="{{ \App\Models\TextWidget::gettitle('title-widget') }} - Posts by category - {{ $category->title }}">

    <div class="container mx-auto flex flex-wrap py-6">
        <!-- Posts Section -->
        <section class="w-full md:w-2/3 flex flex-col items-center px-3">

            <div class=" flex flex-col items-center">

                @foreach ($posts as $post)
                    <x-post-item :post="$post" />
                @endforeach

            </div>

            {{ $posts->onEachSide(1)->links() }}

        </section>

        <x-sidebar />

    </div>

</x-app-layout>

