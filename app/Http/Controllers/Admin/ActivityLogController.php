<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        //sortiramo najnovije prvo
        $query = ActivityLog::with('user')->orderBy('created_at', 'desc');

        //admin popunio filter za datum
        if ($request->filled('start_date') && $request->filled('end_date')) {
            //da bi obuhvatili cele dane
            $query->whereBetween('created_at', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59'
            ]);
        }

        // paginacija
        $logs = $query->paginate(20);

        return view('admin.activities.index', compact('logs'));
    }
}
