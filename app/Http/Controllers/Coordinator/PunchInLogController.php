<?php

namespace App\Http\Controllers\Coordinator;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConfirmPunchInLog;
use App\PunchInLog;
use App\User;
use Illuminate\Support\Facades\Auth;

class PunchInLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  string  $username
     * @return \Illuminate\Http\Response
     */
    public function index($username)
    {
        $student = User::where('username', $username)->first();
        return view('punch-in-logs.index', [
            'punchInLogs' => $student->punchInLogs,
            'student' => $student
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $punchInLog = PunchInLog::findByUuid($uuid);

        return view('punch-in-logs.show', [
            'punchInLog' => $punchInLog
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $punchInLog = PunchInLog::findByUuid($uuid);

        return view('punch-in-logs.edit', [
            'punchInLog' => $punchInLog
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ConfirmPunchInLog  $request
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function update(ConfirmPunchInLog $request, $uuid)
    {
        $validatedData = $request->validated();
        if ($validatedData['coordinator-confirmation'] ?? false) {
            $punchInLog = PunchInLog::findByUuid($uuid);
            $punchInLog->confirmed_by = Auth::user()->id;
            $punchInLog->save();
        }

        return redirect(route('coordinator.punch-in-logs.show', $uuid));
    }
}
