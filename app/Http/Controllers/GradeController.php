<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGradeRequest;
use App\Http\Requests\UpdateGradeRequest;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class GradeController extends Controller
{
    public function create(): View
    {
        Gate::authorize('teacher-level');
        return view('grades.edit');
    }

    public function store(StoreGradeRequest $request)
    {
        $validated = $request->validated();

        $grade = Grade::create($validated);
        dd($grade);
    }

    public function edit(Grade $grade): View
    {
        return View('grades.edit', [
            'grade' => $grade,
            'subjects' => Subject::all(),
        ]);
    }

    public function update(UpdateGradeRequest $request, Grade $grade): View
    {
        Gate::authorize('teacher-level');

        $validated = $request->validated();

        $grade->active = false;
        $grade->save();

        Grade::create([
            'value' => $validated['value'],
            'comment' => $validated['comment'],
            'subject_id' => $validated['subject_id'],
            'user_id' => $grade->user_id,
            'teacher_id' => Auth::id(),
            'identifier' => $grade->identifier,
        ]);

        return View('students.show', [
            'student' => User::find($grade->user_id),
            'subjects' => Subject::all(),
        ]);
    }

    public function history(Grade $grade): View
    {
        $grades = Grade::where('identifier', $grade->identifier)->get();

        return view('grades.history', [
            'grades' => $grades,
            'studentName' => $grade->student->name,
        ]);
    }
}
