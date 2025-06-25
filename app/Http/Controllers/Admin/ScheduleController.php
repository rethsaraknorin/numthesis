<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\ClassSession;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;

class ScheduleController extends Controller
{
    public function index(): View
    {
        $programs = Program::withCount('classSessions')->get();
        return view('admin.schedules.index', compact('programs'));
    }

    public function selectYear(Program $program): View
    {
        return view('admin.schedules.select-year', compact('program'));
    }
    
    public function selectSemester(Program $program, int $year): View
    {
        return view('admin.schedules.select-semester', compact('program', 'year'));
    }

     public function manageBySemester(Program $program, int $year, int $semester): View
    {
        $sessions = ClassSession::where('program_id', $program->id)
            ->where('year', $year)
            ->where('semester', $semester)
            ->with('course')
            ->get();

        $scheduledCoursesMap = $sessions->groupBy(['promotion_name', 'group_name'])
            ->map(function ($groups) {
                return $groups->map(function ($sessions) {
                    return $sessions->pluck('course_id')->unique()->values();
                });
            });

        $courses = $program->courses()
            ->where('year', $year)
            ->where('semester', $semester)
            ->get();
        
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $shifts = ['Morning', 'Afternoon', 'Night', 'Weekend'];

        $groupedSessions = $sessions->groupBy(['promotion_name', 'group_name', 'day_of_week', 'shift']);

        return view('admin.schedules.manage', compact(
            'program', 
            'year', 
            'semester', 
            'groupedSessions', 
            'courses', 
            'days', 
            'shifts',
            'scheduledCoursesMap',
            'sessions'
        ));
    }

    public function store(Request $request, Program $program, int $year, int $semester): RedirectResponse
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'promotion_name' => 'required|string|max:255',
            'group_name' => 'required|string|max:255',
            'day_of_week' => 'required|string',
            'shift' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'lecturer_name' => 'required|string|max:255',
            'lecturer_phone' => 'nullable|string|max:25',
            'room_number' => 'nullable|string|max:50',
        ]);

        $existingSession = ClassSession::where('program_id', $program->id)
            ->where('year', $year)
            ->where('semester', $semester)
            ->where('promotion_name', $validated['promotion_name'])
            ->where('group_name', $validated['group_name'])
            ->first();

        if ($existingSession && $existingSession->shift !== $validated['shift']) {
            throw ValidationException::withMessages([
                'shift' => "This group is already assigned to the '{$existingSession->shift}' shift. You cannot add a session in a different shift.",
            ]);
        }

        $program->classSessions()->create([
            'course_id' => $validated['course_id'],
            'year' => $year,
            'semester' => $semester,
            'promotion_name' => $validated['promotion_name'],
            'group_name' => $validated['group_name'],
            'day_of_week' => $validated['day_of_week'],
            'shift' => $validated['shift'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'lecturer_name' => $validated['lecturer_name'],
            'lecturer_phone' => $validated['lecturer_phone'],
            'room_number' => $validated['room_number'],
        ]);

        return back()->with('success', 'Class session added successfully.');
    }

    public function edit(ClassSession $session): View
    {
        $courses = $session->program->courses()
            ->where('year', $session->year)
            ->where('semester', $session->semester)
            ->orderBy('semester')->get();
            
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $shifts = ['Morning', 'Afternoon', 'Night', 'Weekend'];

        return view('admin.schedules.edit', compact('session', 'courses', 'days', 'shifts'));
    }

    public function update(Request $request, ClassSession $session): RedirectResponse
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'promotion_name' => 'required|string|max:255',
            'group_name' => 'required|string|max:255',
            'day_of_week' => 'required|string',
            'shift' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'lecturer_name' => 'required|string|max:255',
            'lecturer_phone' => 'nullable|string|max:25',
            'room_number' => 'nullable|string|max:50',
        ]);
        
        // --- NEW VALIDATION LOGIC FOR SHIFTS ---
        $otherSession = ClassSession::where('program_id', $session->program_id)
            ->where('year', $session->year)
            ->where('semester', $session->semester)
            ->where('promotion_name', $validated['promotion_name'])
            ->where('group_name', $validated['group_name'])
            ->where('id', '!=', $session->id) // Exclude the current session from the check
            ->first();
        
        if ($otherSession && $otherSession->shift !== $validated['shift']) {
             throw ValidationException::withMessages([
                'shift' => "This group is already assigned to the '{$otherSession->shift}' shift. You cannot change this session to a different shift.",
            ]);
        }
        // --- END OF NEW LOGIC ---
        
        $session->update($validated);
        
        return redirect()
            ->route('admin.schedules.manage', [
                'program' => $session->program_id, 
                'year' => $session->year, 
                'semester' => $session->semester
            ])
            ->with('success', 'Class session updated successfully.');
    }

    public function destroy(ClassSession $session): RedirectResponse
    {
        $session->delete();
        return back()->with('success', 'Class session deleted successfully.');
    }
}