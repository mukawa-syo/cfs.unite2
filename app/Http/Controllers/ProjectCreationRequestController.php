<?php

namespace App\Http\Controllers;

use App\Models\ProjectCreationRequest;
use App\Models\User;
use App\Mail\ProjectCreationRequestNotification;
use App\Mail\ProjectCreationRequestResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ProjectCreationRequestController extends Controller
{
    /**
     * Display a listing of pending requests (for admins)
     */
    public function index()
    {
        // Only admins can view requests
        abort_unless(Auth::user()->hasRole('admin'), 403);

        $requests = ProjectCreationRequest::with(['user', 'reviewer'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.project-creation-requests.index', compact('requests'));
    }

    /**
     * Show the form for creating a new request
     */
    public function create()
    {
        $user = Auth::user();
        
        // Check if user already has a pending request
        $hasPendingRequest = ProjectCreationRequest::where('user_id', $user->id)
            ->where('status', 'pending')
            ->exists();

        // Check if user already has permission
        $alreadyHasPermission = $user->can_create_projects ?? false;

        return view('project-creation-requests.create', compact('hasPendingRequest', 'alreadyHasPermission'));
    }

    /**
     * Store a newly created request
     */
    public function store(Request $request)
    {
        $request->validate([
            'reason' => 'required|string|min:50|max:1000',
        ], [
            'reason.required' => '申請理由を入力してください。',
            'reason.min' => '申請理由は50文字以上で入力してください。',
            'reason.max' => '申請理由は1000文字以内で入力してください。',
        ]);

        $user = Auth::user();

        // Check if user already has a pending request
        $hasPendingRequest = ProjectCreationRequest::where('user_id', $user->id)
            ->where('status', 'pending')
            ->exists();

        if ($hasPendingRequest) {
            return redirect()->route('project-creation-requests.create')
                ->with('error', '審査中の申請が既に存在します。');
        }

        $createdRequest = ProjectCreationRequest::create([
            'user_id' => $user->id,
            'reason' => $request->reason,
            'status' => 'pending',
        ]);

        // Send notification email to admin
        try {
            Mail::to('uknight.sc@hachiouji-uknight.com')->send(new ProjectCreationRequestNotification($createdRequest));
        } catch (\Exception $e) {
            \Log::error('Failed to send notification email', ['error' => $e->getMessage()]);
        }

        return redirect()->route('dashboard')
            ->with('success', 'プロジェクト作成申請を送信しました。審査をお待ちください。');
    }

    /**
     * Display the specified request
     */
    public function show(ProjectCreationRequest $request)
    {
        abort_unless(Auth::user()->hasRole('admin'), 403);

        $request->load(['user', 'reviewer']);

        return view('admin.project-creation-requests.show', compact('request'));
    }

    /**
     * Approve the request
     */
    public function approve(ProjectCreationRequest $request)
    {
        abort_unless(Auth::user()->hasRole('admin'), 403);

        $request->update([
            'status' => 'approved',
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
        ]);

        // Grant permission to the user
        $user = User::findOrFail($request->user_id);
        $user->update(['can_create_projects' => true]);

        // Send approval email to user
        try {
            Mail::to($user->email)->send(new ProjectCreationRequestResult($request, true));
        } catch (\Exception $e) {
            \Log::error('Failed to send approval email', ['error' => $e->getMessage()]);
        }

        return redirect()->route('admin.project-creation-requests.index')
            ->with('success', '申請を承認しました。ユーザーがプロジェクトを作成できるようになりました。');
    }

    /**
     * Reject the request
     */
    public function reject(Request $requestData, ProjectCreationRequest $request)
    {
        abort_unless(Auth::user()->hasRole('admin'), 403);

        $requestData->validate([
            'comment' => 'required|string|max:500',
        ], [
            'comment.required' => '拒否理由を入力してください。',
            'comment.max' => 'コメントは500文字以内で入力してください。',
        ]);

        $request->update([
            'status' => 'rejected',
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
            'comment' => $requestData->comment,
        ]);

        // Send rejection email to user
        try {
            Mail::to($request->user->email)->send(new ProjectCreationRequestResult($request, false));
        } catch (\Exception $e) {
            \Log::error('Failed to send rejection email', ['error' => $e->getMessage()]);
        }

        return redirect()->route('admin.project-creation-requests.index')
            ->with('success', '申請を拒否しました。');
    }

    /**
     * Destroy the request
     */
    public function destroy(ProjectCreationRequest $request)
    {
        abort_unless(Auth::user()->hasRole('admin'), 403);

        $request->delete();

        return redirect()->route('admin.project-creation-requests.index')
            ->with('success', '申請を削除しました。');
    }
}
