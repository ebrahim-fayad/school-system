<?php
namespace App\Repository\Teachers\onlineClasses;

use App\Interface\Teachers\onlineClasses\OnlineClassRepositoryInterface;
use App\Models\Grade;
use App\Models\OnlineClass;
use App\Traits\ZoomTrait;
use MacsiDigital\Zoom\Facades\Zoom;

class OnlineClassRepository implements OnlineClassRepositoryInterface
{
    use ZoomTrait;
    /**
     * @inheritDoc
     */
    public function create() {
        $Grades = Grade::all();
        return view('Teachers.onlineClasses.create', compact('Grades'));
    }

    /**
     * @inheritDoc
     */
    public function destroy($id) {
        try {
            $onlineClass= OnlineClass::findOrFail($id);
            if ($onlineClass->integration) {
            $meeting=Zoom::meeting()->find($onlineClass->meeting_id);
            $meeting->delete();
            $onlineClass->delete();
        } else {
                $onlineClass->delete();
            }
            toastr()->success(trans('messages.success'));
            return redirect()->back();
        } catch (\Exception $e) {
             return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * @inheritDoc
     */
    public function edit($id) {
        $Grades = Grade::all();
        return view('Teachers.onlineClasses.create-indirect-meeting', compact('Grades'));
    }

    /**
     * @inheritDoc
     */
    public function index() {
        $online_classes = OnlineClass::all();
        return view('Teachers.onlineClasses.index',compact('online_classes'));
    }

    /**
     * @inheritDoc
     */
    public function store($request) {
        try {

            $meeting = $this->createMeeting($request);
            OnlineClass::create([
                'integration'=>true,
                'Grade_id' => $request->Grade_id,
                'Classroom_id' => $request->Classroom_id,
                'section_id' => $request->section_id,
                'teacher_id' => 1,
                'meeting_id' => $meeting->id,
                'topic' => $request->topic,
                'start_at' => $request->start_time,
                'duration' => $meeting->duration,
                'password' => $meeting->password,
                'start_url' => $meeting->start_url,
                'join_url' => $meeting->join_url,
            ]);
            toastr()->success(trans('messages.success'));
            return redirect()->route('teacher.onlineClasses.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * @inheritDoc
     */
    public function update($request, $id) {
        try {
            OnlineClass::create([
                'integration' => false,
                'Grade_id' => $request->Grade_id,
                'Classroom_id' => $request->Classroom_id,
                'section_id' => $request->section_id,
                'teacher_id' => 1,
                'meeting_id' => $request->meeting_id,
                'topic' => $request->topic,
                'start_at' => $request->start_time,
                'duration' => $request->duration,
                'password' => $request->password,
                'start_url' => $request->start_url,
                'join_url' => $request->join_url,
            ]);
            toastr()->success(trans('messages.success'));
            return redirect()->route('teacher.onlineClasses.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
