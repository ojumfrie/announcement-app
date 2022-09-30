<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Announcement;
use Validator;
use App\Classes\AnnouncementUpdate;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcement_update = new AnnouncementUpdate;
        $announcement_update->mark_announcements_active_inactive();

        $announcements = Announcement::orderBy('id')
                            ->take(20)
                            ->get();
        
        if ($announcements)
        {
            return response()->json([
                'status' => 200,
                'announcements' => $announcements,
                'public' => 'no',
            ]);
        }
    }

    public function index_public()
    {
        // For public viewing data

        $announcement_update = new AnnouncementUpdate;
        $announcement_update->mark_announcements_active_inactive();

        $announcements = Announcement::where('active', 1)
        ->orderByDesc('id')
        ->take(20)
        ->get();

        if ($announcements)
        {
            return response()->json([
                'status' => 200,
                'announcements' => $announcements,
                'public' => 'yes',
            ]);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:191',
            'content' => 'required|max:700',
            'start_date' => 'required|max:20',
            'end_date' => 'required|max:20',
            'active' => 'required|integer',
        ]);

        if ($validator->fails())
        {
            return response()->json([
                'validation_error' => $validator->messages()
            ]);
        }
        else
        {
            $announcement = new Announcement;
            $announcement->title = $request->input('title');
            $announcement->content = $request->input('content');
            $announcement->start_date = $request->input('start_date');
            $announcement->end_date = $request->input('end_date');
            $announcement->active = $request->input('active');
            $announcement->save();

            // if ($announcement)
            // {
                return response()->json([
                    'status' => 200,
                    'message' => "Announcement successfully added!",
                ]);
            // }
        }
    }

    public function edit($id)
    {
        $announcement = Announcement::find($id);

        if ($announcement)
        {
            return response()->json([
                'status' => 200,
                'announcement' => $announcement,
            ]);
        }
        else
        {
            return response()->json([
                'status' => 404,
                'message' => 'Announcement ID not found.',
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:191',
            'content' => 'required|max:700',
            'start_date' => 'required|max:20',
            'end_date' => 'required|max:20',
            'active' => 'required|integer',
        ]);

        if ($validator->fails())
        {
            return response()->json([
                'state' => 400,
                'validation_error' => $validator->messages(),
            ]);
        }
        else
        {
            $announcement = Announcement::find($id);

            if ($announcement)
            {
                $announcement->title = $request->input('title');
                $announcement->content = $request->input('content');
                $announcement->start_date = $request->input('start_date');
                $announcement->end_date = $request->input('end_date');
                $announcement->active = $request->input('active');
                $announcement->update();

                return response()->json([
                    'status' => 200,
                    'message' => 'Announcement successfully updated!'
                ]);
            }
            else
            {
                return response()->json([
                    'status' => 404,
                    'message' => 'Announcement ID cannot be found.'
                ]);
            }
        }
    }

    public function destroy($id)
    {
        $announcement = Announcement::find($id);

        // dd($announcement);

        if ($announcement != null)
        {
            $announcement->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Announcement successfully deleted!',
            ]);
        }
        else
        {
            return response()->json([
                'status' => 404,
                'message' => 'Announcement ID passed does not much any in the records.',
            ]);
        }
    }
}
