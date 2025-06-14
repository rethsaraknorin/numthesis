<aside class="w-64 min-h-screen bg-gray-800 text-white flex flex-col">
    <!-- Brand Logo -->
    <a href="/dashboard" class="flex items-center px-4 py-4 bg-gray-900 hover:bg-gray-700">
        <img src="/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="w-10 h-10 rounded-full mr-3">
        <span class="text-lg font-semibold">AppName</span>
    </a>

    <!-- Sidebar -->
    <div class="flex-1 px-4 py-6">
        <!-- User Panel -->
        <div class="flex items-center mb-6">
            <img src="/dist/img/user2-160x160.jpg" alt="User Image" class="w-10 h-10 rounded-full mr-3">
            <div>
                <p class="font-medium">User Name</p>
            </div>
        </div>

        <!-- Navigation -->
        <nav>
            <ul class="space-y-2">
                <li>
                    <a href="/dashboard" class="flex items-center px-3 py-2 rounded-md hover:bg-gray-700 {{ request()->is('dashboard') ? 'bg-gray-700' : '' }}">
                        <i class="fas fa-home mr-2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center px-3 py-2 rounded-md hover:bg-gray-700">
                        <i class="fas fa-box mr-2"></i>
                        <span>Element 1</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
