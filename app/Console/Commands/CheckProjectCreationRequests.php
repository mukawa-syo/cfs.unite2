<?php

namespace App\Console\Commands;

use App\Models\ProjectCreationRequest;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProjectCreationRequestNotification;

class CheckProjectCreationRequests extends Command
{
    protected $signature = 'check:requests';
    protected $description = 'Check for pending project creation requests';

    public function handle()
    {
        $requests = ProjectCreationRequest::where('status', 'pending')
            ->whereNull('notified_at')
            ->get();

        foreach ($requests as $request) {
            try {
                Mail::to('uknight.sc@hachiouji-uknight.com')
                    ->send(new ProjectCreationRequestNotification($request));
                
                // Mark as notified
                $request->update(['notified_at' => now()]);
                
                $this->info("Notification sent for request ID: {$request->id}");
            } catch (\Exception $e) {
                $this->error("Failed to send notification for request ID: {$request->id}: {$e->getMessage()}");
            }
        }

        return Command::SUCCESS;
    }
}

