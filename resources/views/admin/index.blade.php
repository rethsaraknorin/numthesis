<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- UPDATED: Cards with Secondary Stats --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                
                {{-- Total Users Card --}}
                <div class="bg-blue-100 dark:bg-blue-900/50 border border-blue-200 dark:border-blue-800 overflow-hidden shadow-sm rounded-lg p-6 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-medium text-blue-800 dark:text-blue-300">Total Users</h3>
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-4.67c.12-.318.232-.656.328-1.014a7.454 7.454 0 011.472-3.053c.52-1.171 1.232-2.144 2.114-2.853M12 14.25a5.25 5.25 0 00-10.5 0v.25c0 .591.212 1.158.585 1.606a5.286 5.286 0 003.18 1.878A5.286 5.286 0 0012 14.25v-.25z" /></svg>
                        </div>
                        <p class="mt-1 text-3xl font-semibold text-gray-900 dark:text-gray-100">{{ $totalUserCount }}</p>
                        <div class="text-xs text-gray-600 dark:text-gray-400 mt-2">
                            <p><span class="font-bold text-green-600">{{ $approvedStudentCount }}</span> Approved Students</p>
                            <p><span class="font-bold text-yellow-600">{{ $pendingRequestCount }}</span> Pending Requests</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.users.all') }}" class="text-sm font-medium text-blue-700 dark:text-blue-200 hover:underline mt-4 self-start">View All Users &rarr;</a>
                </div>

                {{-- Total Programs Card --}}
                <div class="bg-purple-100 dark:bg-purple-900/50 border border-purple-200 dark:border-purple-800 overflow-hidden shadow-sm rounded-lg p-6 flex flex-col justify-between">
                     <div>
                        <div class="flex items-center justify-between">
                           <h3 class="text-lg font-medium text-purple-800 dark:text-purple-300">Total Programs</h3>
                           <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path d="M12 18.375a9.375 9.375 0 100-18.75 9.375 9.375 0 000 18.75z" /><path d="M8.25 9.75h7.5v.008h-7.5V9.75z" /><path d="M12 14.25v.008" /><path d="M10.125 12h3.75" /><path d="M12 3.75v1.5" /><path d="M12 18.75v1.5" /><path d="M3.75 12h1.5" /><path d="M18.75 12h1.5" /><path d="M5.69 6.075l1.06-1.06" /><path d="M17.25 18.31l1.06-1.06" /><path d="M5.69 17.925l1.06 1.06" /><path d="M17.25 5.69l1.06 1.06" /></svg>
                        </div>
                        <p class="mt-1 text-3xl font-semibold text-gray-900 dark:text-gray-100">{{ $totalPrograms }}</p>
                        <div class="text-xs text-gray-600 dark:text-gray-400 mt-2">
                            <p>Containing <span class="font-bold">{{ $totalCourses }}</span> total courses.</p>
                        </div>
                    </div>
                     <a href="{{ route('admin.programs.index') }}" class="text-sm font-medium text-purple-700 dark:text-purple-200 hover:underline mt-4 self-start">Manage Programs &rarr;</a>
                </div>
                
                {{-- Total Books Card --}}
                <div class="bg-teal-100 dark:bg-teal-900/50 border border-teal-200 dark:border-teal-800 overflow-hidden shadow-sm rounded-lg p-6 flex flex-col justify-between">
                    <div>
                       <div class="flex items-center justify-between">
                          <h3 class="text-lg font-medium text-teal-800 dark:text-teal-300">Total Books</h3>
                          <svg class="w-6 h-6 text-teal-600 dark:text-teal-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" /></svg>
                       </div>
                       <p class="mt-1 text-3xl font-semibold text-gray-900 dark:text-gray-100">{{ $totalBooks }}</p>
                        <div class="text-xs text-gray-600 dark:text-gray-400 mt-2">
                            <p><span class="font-bold">+{{ $recentBooksCount }}</span> added this week.</p>
                        </div>
                   </div>
                    <a href="{{ route('admin.library.index') }}" class="text-sm font-medium text-teal-700 dark:text-teal-200 hover:underline mt-4 self-start">Manage Library &rarr;</a>
               </div>
            </div>

            {{-- The rest of the dashboard remains the same --}}
            <div class="mt-8 grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">New User Registrations (Last 7 Days)</h3>
                    <canvas id="userRegistrationsChart" class="mt-4"></canvas>
                </div>
                <div class="space-y-6">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Recent Student Requests</h3>
                        <ul class="mt-4 space-y-4">
                            @forelse($recentPendingUsers as $user)
                                <li class="flex items-center space-x-3">
                                    <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="w-10 h-10 rounded-full flex-shrink-0">
                                    <div>
                                        <p class="text-sm font-semibold text-gray-800 dark:text-gray-200">{{ $user->name }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">ID: {{ $user->student_id }}</p>
                                    </div>
                                </li>
                            @empty
                                <p class="text-sm text-gray-500 dark:text-gray-400">No pending student requests.</p>
                            @endforelse
                        </ul>
                    </div>
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Recently Added Books</h3>
                        <ul class="mt-4 space-y-4">
                            @forelse($latestBooks as $book)
                                <li class="flex items-center space-x-3">
                                    <img src="{{ $book->picture ? asset('storage/' . $book->picture) : 'https://placehold.co/100/4A5568/E2E8F0?text=Book' }}" alt="Cover" class="w-10 h-12 object-cover rounded flex-shrink-0">
                                    <div>
                                        <p class="text-sm font-semibold text-gray-800 dark:text-gray-200">{{ $book->title }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">by {{ $book->author }}</p>
                                    </div>
                                </li>
                            @empty
                                <p class="text-sm text-gray-500 dark:text-gray-400">No books added recently.</p>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('userRegistrationsChart').getContext('2d');
            const userChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($chartLabels),
                    datasets: [{
                        label: 'New Users',
                        data: @json($chartData),
                        borderColor: 'rgba(79, 70, 229, 1)',
                        backgroundColor: 'rgba(79, 70, 229, 0.1)',
                        fill: true,
                        tension: 0.3
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: { beginAtZero: true, ticks: { stepSize: 1 } }
                    }
                }
            });
        });
    </script>
    @endpush
</x-admin-layout>