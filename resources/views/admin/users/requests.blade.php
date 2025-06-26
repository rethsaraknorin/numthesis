<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Student Verification Requests
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Display Success/Error Messages --}}
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
                        This list includes all registered users who have submitted their official Student ID and are awaiting verification. Please verify their details before approving.
                    </p>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">User Details</th>
                                    <th scope="col" class="px-6 py-3">Submitted Student ID</th>
                                    <th scope="col" class="px-6 py-3">Submitted Promotion / Group</th>
                                    <th scope="col" class="px-6 py-3 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pendingUsers as $user)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-4">
                                            <div class="font-medium text-gray-900 dark:text-white">{{ $user->name }}</div>
                                            <div class="text-xs text-gray-500">{{ $user->email }}</div>
                                        </td>
                                        <td class="px-6 py-4 font-mono text-indigo-600 dark:text-indigo-400">
                                            {{ $user->student_id }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div>Promotion: <span class="font-semibold">{{ $user->promotion_name ?? 'N/A' }}</span></div>
                                            <div>Group: <span class="font-semibold">{{ $user->group_name ?? 'N/A' }}</span></div>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            {{-- Approval Form --}}
                                            <form action="{{ route('admin.users.approve', $user) }}" method="POST">
                                                @csrf
                                                <x-primary-button>Approve</x-primary-button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                            No users are pending verification.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>