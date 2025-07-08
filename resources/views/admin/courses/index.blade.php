<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Courses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div x-data="{
                programs: {{ json_encode($programs) }},
                activeProgram: null,
                activeYear: 1, // Default to Year 1
                
                // State for inline forms
                showAddForm: { 1: false, 2: false },
                newCourse: { name: '', credits: '', hours: '' },

                init() {
                    // Set the first program as active by default
                    if (this.programs.length > 0) {
                        this.activeProgram = this.programs[0].id;
                    }
                },

                selectProgram(programId) {
                    this.activeProgram = programId;
                    this.activeYear = 1; // Reset to Year 1 when changing program
                    this.resetForms();
                },
                selectYear(year) {
                    this.activeYear = year;
                    this.resetForms();
                },
                getCourses(semester) {
                    if (!this.activeProgram || !this.activeYear) return [];
                    const program = this.programs.find(p => p.id === this.activeProgram);
                    if (!program) return [];
                    return program.courses.filter(c => c.year == this.activeYear && c.semester == semester);
                },
                resetForms() {
                    this.showAddForm = { 1: false, 2: false };
                    this.newCourse = { name: '', credits: '', hours: '' };
                },
                async addCourse(semester) {
                    if (!this.newCourse.name) {
                        alert('Course name is required.');
                        return;
                    }

                    const response = await fetch('{{ route('admin.courses.inlineStore') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            ...this.newCourse,
                            program_id: this.activeProgram,
                            year: this.activeYear,
                            semester: semester
                        })
                    });

                    if (response.ok) {
                        const course = await response.json();
                        const program = this.programs.find(p => p.id === this.activeProgram);
                        program.courses.push(course);
                        this.resetForms();
                    } else {
                        alert('Failed to add course. Please check the console for errors.');
                        console.error(await response.json());
                    }
                }
            }" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            Course Management Board
                        </h3>
                        <a href="{{ route('admin.courses.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500">
                            Add New Course
                        </a>
                    </div>
                    
                    <div class="border-b border-gray-200 dark:border-gray-700">
                        <nav class="flex -mb-px space-x-6" aria-label="Tabs">
                            <template x-for="program in programs" :key="program.id">
                                <button @click="selectProgram(program.id)"
                                    :class="activeProgram === program.id ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:hover:text-gray-200'"
                                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                    <span x-text="program.name"></span>
                                </button>
                            </template>
                        </nav>
                    </div>

                    <div x-show="activeProgram" class="mt-4 border-b border-gray-200 dark:border-gray-700 pb-4">
                        <nav class="flex flex-wrap gap-4">
                            <template x-for="year in [1, 2, 3, 4]" :key="year">
                                <button @click="selectYear(year)"
                                    :class="activeYear === year ? 'bg-indigo-600 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600'"
                                    class="px-4 py-2 text-sm font-medium rounded-md transition">
                                    <span x-text="'Year ' + year"></span>
                                </button>
                            </template>
                        </nav>
                    </div>

                    <div x-show="activeYear" x-transition class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Semester 1</h4>
                            <div class="space-y-2">
                                <template x-for="course in getCourses(1)" :key="course.id">
                                    <div class="flex justify-between items-center p-3 bg-gray-100 dark:bg-gray-900/50 rounded-md">
                                        <div>
                                            <p class="font-medium" x-text="course.name"></p>
                                            <p class="text-xs text-gray-500" x-text="(course.credits || 'N/A') + ' Credits / ' + (course.hours || 'N/A') + ' Hours'"></p>
                                        </div>
                                        <div class="flex items-center space-x-4">
                                            <a :href="`/admin/courses/${course.id}/edit`" class="text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                            <form :action="`/admin/courses/${course.id}`" method="POST" onsubmit="return confirm('Are you sure?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-sm font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </template>
                                <template x-if="activeProgram && activeYear && getCourses(1).length === 0 && !showAddForm[1]">
                                    <p class="text-gray-500 dark:text-gray-400 text-sm italic">No courses found.</p>
                                </template>

                                <div x-show="showAddForm[1]" class="p-3 bg-gray-100 dark:bg-gray-900/50 rounded-md space-y-2">
                                    <input type="text" x-model="newCourse.name" placeholder="Course Name" class="block w-full text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 rounded-md shadow-sm">
                                    <div class="grid grid-cols-2 gap-2">
                                            <input type="number" x-model="newCourse.credits" placeholder="Credits" class="block w-full text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 rounded-md shadow-sm">
                                            <input type="number" x-model="newCourse.hours" placeholder="Hours" class="block w-full text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 rounded-md shadow-sm">
                                    </div>
                                    <div class="flex justify-end gap-2">
                                        <button @click="showAddForm[1] = false" class="text-sm text-gray-600">Cancel</button>
                                        <button @click="addCourse(1)" class="text-sm font-semibold text-indigo-600">Save</button>
                                    </div>
                                </div>
                                <button @click="showAddForm[1] = true" x-show="!showAddForm[1]" class="w-full text-left text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:underline p-2">+ Add a course</button>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Semester 2</h4>
                            <div class="space-y-2">
                                    <template x-for="course in getCourses(2)" :key="course.id">
                                        <div class="flex justify-between items-center p-3 bg-gray-100 dark:bg-gray-900/50 rounded-md">
                                        <div>
                                            <p class="font-medium" x-text="course.name"></p>
                                            <p class="text-xs text-gray-500" x-text="(course.credits || 'N/A') + ' Credits / ' + (course.hours || 'N/A') + ' Hours'"></p>
                                        </div>
                                        <div class="flex items-center space-x-4">
                                            <a :href="`/admin/courses/${course.id}/edit`" class="text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                            <form :action="`/admin/courses/${course.id}`" method="POST" onsubmit="return confirm('Are you sure?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-sm font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </template>
                                    <template x-if="activeProgram && activeYear && getCourses(2).length === 0 && !showAddForm[2]">
                                    <p class="text-gray-500 dark:text-gray-400 text-sm italic">No courses found.</p>
                                </template>

                                <div x-show="showAddForm[2]" class="p-3 bg-gray-100 dark:bg-gray-900/50 rounded-md space-y-2">
                                    <input type="text" x-model="newCourse.name" placeholder="Course Name" class="block w-full text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 rounded-md shadow-sm">
                                    <div class="grid grid-cols-2 gap-2">
                                            <input type="number" x-model="newCourse.credits" placeholder="Credits" class="block w-full text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 rounded-md shadow-sm">
                                            <input type="number" x-model="newCourse.hours" placeholder="Hours" class="block w-full text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 rounded-md shadow-sm">
                                    </div>
                                    <div class="flex justify-end gap-2">
                                        <button @click="showAddForm[2] = false" class="text-sm text-gray-600">Cancel</button>
                                        <button @click="addCourse(2)" class="text-sm font-semibold text-indigo-600">Save</button>
                                    </div>
                                </div>
                                <button @click="showAddForm[2] = true" x-show="!showAddForm[2]" class="w-full text-left text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:underline p-2">+ Add a course</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>