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
        return view('admin.schedules.index', ['programs' => Program::withCount('classSessions')->get()]);
    }

    public function selectYear(Program $program)
    {
        return view('admin.schedules.select-year', compact('program'));
    }

    public function selectSemester(Program $program, $year)
    {
        return view('admin.schedules.select-semester', compact('program', 'year'));
    }

    public function manageBySemester(Request $request, Program $program, $year, $semester)
    {
        // 1. Get all necessary data
        $sessions = ClassSession::where('program_id', $program->id)
            ->where('year', $year)
            ->where('semester', $semester)
            ->with('course')
            ->orderBy('start_time')
            ->get();
            
        $courses = Course::where('program_id', $program->id)
            ->where('year', $year)
            ->where('semester', $semester)
            ->get();
        
        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'];
        
        // 2. Determine the active promotion tab
        $promotions = $sessions->pluck('promotion_name')->unique()->sort()->values();
        $activePromotion = $request->query('promotion', $promotions->first());

        // 3. Build the schedule data structure
        $scheduleData = collect();
        if ($activePromotion) {
            $scheduleData = $sessions->where('promotion_name', $activePromotion)
                ->groupBy('group_name')
                ->map(function ($groupSessions) {
                    $grid = [];
                    foreach ($groupSessions as $session) {
                        $timeLabel = Carbon::parse($session->start_time)->format('h:i A') . ' - ' . Carbon::parse($session->end_time)->format('h:i A');
                        $day = ucfirst(strtolower($session->day_of_week));
                        $grid[$timeLabel][$day][] = $session;
                    }
                    ksort($grid);
                    return $grid;
                });
        }
        
        // 4. Return the view with all the data
        return view('admin.schedules.manage', compact(
            'program', 'year', 'semester', 'courses', 'scheduleData', 
            'promotions', 'days', 'activePromotion'
        ));
    }

    public function store(Request $request, Program $program, $year, $semester)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'lecturer_name' => 'required|string|max:255',
            'room_number' => 'required|string|max:255',
            'day_of_week' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'promotion_name' => 'required|string|max:255',
            'group_name' => 'required|string|max:255',
            'shift' => 'required|string|in:Morning,Afternoon,Night',
        ]);
        ClassSession::create($validated + ['program_id' => $program->id, 'year' => $year, 'semester' => $semester]);
        return redirect()->route('admin.schedules.manage', [
            'program' => $program->id, 'year' => $year, 'semester' => $semester, 'promotion' => $validated['promotion_name']
        ])->with('success', 'Class session added successfully.');
    }

    public function edit(ClassSession $session)
    {
        $courses = Course::where('program_id', $session->program_id)
            ->where('year', $session->year)->where('semester', $session->semester)->get();
        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'];
        $shifts = ['Morning', 'Afternoon', 'Night'];
        return view('admin.schedules.edit', compact('session', 'courses', 'days', 'shifts'));
    }

    public function update(Request $request, ClassSession $session)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'lecturer_name' => 'required|string|max:255',
            'room_number' => 'required|string|max:255',
            'day_of_week' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'promotion_name' => 'required|string|max:255',
            'group_name' => 'required|string|max:255',
            'shift' => 'required|string|in:Morning,Afternoon,Night',
        ]);
        $session->update($validated);
        return redirect()->route('admin.schedules.manage', [
            'program' => $session->program_id, 'year' => $session->year, 'semester' => $session->semester, 'promotion' => $validated['promotion_name']
        ])->with('success', 'Class session updated successfully.');
    }

    public function destroy(ClassSession $session)
    {
        $program_id = $session->program_id; $year = $session->year; $semester = $session->semester;
        $promotion_name = $session->promotion_name;
        $session->delete();
        return redirect()->route('admin.schedules.manage', [
            'program' => $program_id, 'year' => $year, 'semester' => $semester, 'promotion' => $promotion_name,
        ])->with('success', 'Class session deleted successfully.');
    }
}