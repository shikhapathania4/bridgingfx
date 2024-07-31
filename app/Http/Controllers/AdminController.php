<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\ContactUs;
use Illuminate\Support\Facades\Mail;
use App\Mail\FeedbackMail;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\SubmissionsExport;


class AdminController extends Controller
{

    public function index()
    {
        $submissions = ContactUs::all();
        return view('admin.dashboard', compact('submissions'));
    }

    public function viewSubmission($id)
    {
        $submission = ContactUs::findOrFail($id); 
        return response()->json($submission);
    }

    public function sendEmail(Request $request)
    {

        $request->validate([
            'submission_id' => 'required|exists:contact_us,id',
            'submission_email' => 'required|email',
        ]);

        $submission = ContactUs::find($request->submission_id);
        $feedback = $request->message;
         Mail::to($submission->email)->send(new FeedbackMail($feedback));

        return redirect()->back()->with('success', 'Feedback sent successfully.');
    }

    public function export(){

        return Excel::download(new SubmissionsExport, 'submissions.xlsx');

    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Logged out successfully.');
    }

}
