<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Session;

class DocumentUploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dailyEntryPdf(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:pdf|max:20480',
            'entry_date' => 'required|date_format:m-d-Y',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $locationId = $this->authorizedLocationId();
        if (!$locationId) {
            return redirect()->back()->withErrors(['file' => 'Select a store assigned to your account before uploading.']);
        }

        $entryDate = date('Y-m-d', strtotime($request->input('entry_date')));
        $directory = storage_path('app/uploads/daily-entry/' . $locationId . '/' . $entryDate);
        $this->ensureDirectory($directory);
        $fileName = 'daily-entry-' . date('Ymd-His') . '-' . uniqid() . '.pdf';
        $request->file('file')->move($directory, $fileName);

        return redirect()->back()->with('message', 'Daily entry PDF uploaded successfully.');
    }

    public function laborReportExcel(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xls,xlsx|max:20480',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $locationId = $this->authorizedLocationId();
        if (!$locationId) {
            return redirect()->back()->withErrors(['file' => 'Select a store assigned to your account before uploading.']);
        }

        $extension = strtolower($request->file('file')->getClientOriginalExtension());
        $directory = storage_path('app/uploads/labor-reports/' . $locationId);
        $this->ensureDirectory($directory);
        $fileName = 'labor-report-' . date('Ymd-His') . '-' . uniqid() . '.' . $extension;
        $request->file('file')->move($directory, $fileName);

        return redirect()->back()->with('message', 'Labor report Excel file uploaded successfully.');
    }

    private function authorizedLocationId()
    {
        $locationId = Session::get('location_id');
        if (!$locationId) {
            return null;
        }

        $assigned = DB::table('user_locations')
            ->where('user', Auth::id())
            ->where('location', $locationId)
            ->exists();

        return $assigned ? $locationId : null;
    }

    private function ensureDirectory($directory)
    {
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }
    }
}
