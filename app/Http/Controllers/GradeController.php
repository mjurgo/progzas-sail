<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGradeRequest;
use App\Http\Requests\UpdateGradeRequest;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\User;
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

        $grade->value = $validated['value'];
        $grade->comment = $validated['comment'];
        $grade->subject_id = $validated['subject_id'];

        $grade->save();

        return View('students.show', [
            'student' => User::find($grade->user_id),
            'subjects' => Subject::all(),
        ]);
    }

    public function show(Grade $grade)
    {
        //
    }
}
