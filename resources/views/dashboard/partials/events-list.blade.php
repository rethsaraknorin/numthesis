{{-- This is a new partial view for the events list --}}
<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
    <div class="p-6 text-gray-900 dark:text-gray-100">
        <h4 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Latest Events & News</h4>
        <div class="space-y-5">
            @forelse($latestEvents as $event)
                {{-- WRAP the entire div in an anchor tag --}}
                <a href="{{ route('page.event.show', $event) }}" class="flex items-start space-x-4 group p-2 -m-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-150">
                    @if($event->image_path)
                        <img src="{{ asset('storage/' . $event->image_path) }}" alt="{{ $event->title }}" class="h-20 w-20 object-cover rounded-lg flex-shrink-0">
                    @else
                        <div class="h-20 w-20 bg-gray-200 dark:bg-gray-700 rounded-lg flex-shrink-0 flex items-center justify-center">
                           <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    @endif
                    <div>
                        {{-- ADD group-hover classes to the title for a visual cue --}}
                        <p class="font-semibold text-gray-800 dark:text-gray-200 leading-tight group-hover:text-indigo-600 dark:group-hover:text-indigo-400">{{ $event->title }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ \Carbon\Carbon::parse($event->date)->format('F j, Y') }}</p>
                        {{-- The description was already in the correct format, so no changes here --}}
                        <div class="text-sm text-gray-600 dark:text-gray-500 mt-1 line-clamp-2">{!! nl2br(e($event->description)) !!}</div>
                    </div>
                </a>
            @empty
                <p class="text-gray-500 dark:text-gray-400">No recent events.</p>
            @endforelse
        </div>
    </div>
</div>