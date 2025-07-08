<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassSession;
use App\Models\Program;
use App\Models\Course;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function index()
    {
        $programs = Program::withCount('classSessions')->get();
        return view('admin.schedules.index', compact('programs'));
    }

    public function selectYear(Program $program)
    {
        return view('admin.schedules.select-year', compact('program'));
    }

    public function selectSemester(Program $program, $year)
    {
        return view('admin.schedules.select-semester', compact('program', 'year'));
    }

    public function manageBySemester(Program $program, $year, $semester)
    {
        $sessions = ClassSession::where('program_id', $program->id)
            ->where('year', $year)
            ->where('semester', $semester)
            ->with('course')
            ->get();
            
        $courses = Course::where('program_id', $program->id)
            ->where('year', $year)
            ->where('semester', $semester)
            ->get();

        $scheduleData = [];
        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'];

        $groupedByPromotion = $sessions->groupBy('promotion_name');

        foreach($groupedByPromotion as $promotion => $promotionSessions) {
            $groupedByGroup = $promotionSessions->groupBy('group_name');

            foreach($groupedByGroup as $group => $groupSessions) {
                $grid = [];
                $labels = [];

                foreach($groupSessions as $session) {
                    $startTime = Carbon::parse($session->start_time)->format('H:i');
                    $day = strtolower($session->day_of_week);

                    $grid[$startTime][$day] = $session;

                    if (!isset($labels[$startTime])) {
                        $labels[$startTime] = Carbon::parse($session->start_time)->format('h:i A') . ' - ' . Carbon::parse($session->end_time)->format('h:i A');
                    }
                }
                ksort($labels);
                $scheduleData[$promotion][$group] = [
                    'grid' => $grid,
                    'labels' => $labels,
                ];
            }
        }

        $promotions = $sessions->pluck('promotion_name')->unique()->sort()->values();

        return view('admin.schedules.manage', compact('program', 'year', 'semester', 'courses', 'scheduleData', 'promotions', 'days'));
    }

    public function store(Request $request, Program $program, $year, $semester)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'lecturer_name' => 'required|string|max:255',
            'lecturer_phone' => 'nullable|string|max:20', // ADDED
            'room_number' => 'required|string|max:255',
            'day_of_week' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'promotion_name' => 'required|string|max:255',
            'group_name' => 'required|string|max:255',
            'shift' => 'nullable|string|max:255',
        ]);

        $validated['day_of_week'] = strtolower($validated['day_of_week']);

        $session = ClassSession::create(array_merge($validated, [
            'program_id' => $program->id,
            'year' => $year,
            'semester' => $semester,
        ]));

        // ** THE FIX: Return the new session as JSON for the frontend to handle **
        return response()->json($session->load('course'));
    }

    public function edit(ClassSession $session)
    {
        $program = $session->program;
        $courses = Course::where('program_id', $program->id)
            ->where('year', $session->year)
            ->where('semester', $session->semester)
            ->get();
        
        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'];
            
        return view('admin.schedules.edit', compact('session', 'courses', 'days'));
    }

    public function update(Request $request, ClassSession $session)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'lecturer_name' => 'required|string|max:255',
            'lecturer_phone' => 'nullable|string|max:20', // ADDED
            'room_number' => 'required|string|max:255',
            'day_of_week' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'promotion_name' => 'required|string|max:255',
            'group_name' => 'required|string|max:255',
            'shift' => 'nullable|string|max:255',
        ]);

        $validated['day_of_week'] = strtolower($validated['day_of_week']);

        $session->update($validated);

        return redirect()->route('admin.schedules.manage', [
            'program' => $session->program_id, 
            'year' => $session->year, 
            'semester' => $session->semester
        ])->with('success', 'Class session updated successfully.');
    }

    public function destroy(ClassSession $session)
    {
        $session->delete();
        return back()->with('success', 'Class session deleted successfully.');
    }
}
