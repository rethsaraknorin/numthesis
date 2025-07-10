@props(['events'])

{{-- School Events Section --}}
<section id="events" class="py-20 bg-gray-50 dark:bg-gray-800/50">
    <div class="container mx-auto px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white">University Events</h2>
            <p class="text-gray-600 dark:text-gray-400 mt-2">Stay connected with our vibrant campus life.</p>
            <div class="w-24 h-1 bg-cyan-500 mx-auto mt-4"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($events as $event)
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden flex flex-col">
                    <img src="{{ $event->image_path ? asset('storage/' . $event->image_path) : 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=2070&auto=format&fit=crop' }}" 
                         class="w-full h-56 object-cover" 
                         alt="{{ $event->title }}">
                    <div class="p-6 flex flex-col flex-grow">
                        <p class="text-sm font-semibold text-cyan-500">{{ \Carbon\Carbon::parse($event->date)->format('M d, Y') }}</p>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mt-2">{{ $event->title }}</h3>
                        <p class="text-gray-600 dark:text-gray-400 mt-2 line-clamp-3 flex-grow">{{ $event->description }}</p>
                        
                        {{-- UPDATED: "See More" link to the event detail page --}}
                        <div class="mt-4">
                            <a href="{{ route('page.event.show', $event) }}" class="font-semibold text-indigo-600 dark:text-indigo-400 hover:underline">
                                See More &rarr;
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-lg text-gray-600 dark:text-gray-400">No upcoming events at the moment. Please check back soon!</p>
                </div>
            @endforelse
        </div>
    </div>
</section>