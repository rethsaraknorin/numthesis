<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Weekly Schedule') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-8">
                
                @if(Auth::user()->is_approved && Auth::user()->promotion_name && Auth::user()->group_name)

                    @forelse($schedules->sortKeys() as $year => $semesters)
                        @foreach($semesters->sortKeys() as $semester => $scheduleData)
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 text-gray-900 dark:text-gray-100">
                                    @php
                                        $firstSession = $scheduleData->flatten(2)->first();
                                        $groupPromotion = $firstSession ? $firstSession->promotion_name : Auth::user()->promotion_name;
                                        $groupName = $firstSession ? $firstSession->group_name : Auth::user()->group_name;
                                        $groupShiftType = $firstSession ? ($firstSession->shift === 'Weekend' ? 'Weekend' : 'Weekday') : 'Weekday';

                                        $daysToShow = ($groupShiftType === 'Weekend') 
                                            ? ['Saturday', 'Sunday'] 
                                            : ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
                                        
                                        $shiftsToShow = ($groupShiftType === 'Weekend')
                                            ? ['Weekend']
                                            : ['Morning', 'Afternoon', 'Night'];

                                        $actualShifts = $scheduleData->flatten(2)->pluck('shift')->unique()->toArray();
                                    @endphp
                                    
                                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                                        {{ __('Year') }} {{ $year }}, {{ __('Semester') }} {{ $semester }}
                                    </h3>
                                    <p class="text-md text-gray-600 dark:text-gray-400 mb-6">
                                        {{ __('Promotion') }}: {{ $groupPromotion }} / {{ __('Group') }}: {{ $groupName }}
                                    </p>
                                    
                                    <div class="overflow-x-auto">
                                        <table class="w-full min-w-max border-collapse text-left">
                                            <thead>
                                                <tr>
                                                    <th class="border-b-2 dark:border-gray-700 p-4 w-1/5">{{ __('Shift') }}</th>
                                                    @foreach($daysToShow as $dayName)
                                                        <th class="border-b-2 dark:border-gray-700 p-4 text-center">{{ __($dayName) }}</th>
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($shiftsToShow as $shiftName)
                                                    @if(in_array($shiftName, $actualShifts))
                                                        <tr class="border-b dark:border-gray-700">
                                                            <td class="p-4 font-bold align-top">{{ __($shiftName) }}</td>
                                                            @foreach($daysToShow as $dayName)
                                                                <td class="p-2 align-top @if(!$loop->last) border-r dark:border-gray-700 @endif">
                                                                    @if(isset($scheduleData[$dayName][$shiftName]))
                                                                        <div class="space-y-2">
                                                                            @foreach($scheduleData[$dayName][$shiftName] as $session)
                                                                                <div class="bg-indigo-50 dark:bg-indigo-900/50 p-3 rounded-lg text-sm text-center">
                                                                                    <p class="font-bold text-gray-800 dark:text-gray-200">{{ $session->course->name }}</p>
                                                                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">{{ \Carbon\Carbon::parse($session->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($session->end_time)->format('h:i A') }}</p>
                                                                                    <p class="text-xs text-gray-600 dark:text-gray-400">{{ __('Lecturer') }}: {{ $session->lecturer_name }}</p>
                                                                                    @if($session->room_number)<p class="text-xs text-gray-600 dark:text-gray-400">{{ __('Room') }}: {{ $session->room_number }}</p>@endif
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    @endif
                                                                </td>
                                                            @endforeach
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @empty
                         <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                             <div class="p-6 text-center text-gray-500 dark:text-gray-400">
                                {{ __('no_schedule_set') }}
                            </div>
                        </div>
                    @endforelse

                @else
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                         <div class="p-6 text-center text-gray-500 dark:text-gray-400">
                            {!! __('not_approved_student', ['profile_link' => route('profile.edit')]) !!}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>