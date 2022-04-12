<?php

namespace App\Console\Commands;

use App\Models\Comment;
use App\Service\BannedWord\BannedWordVerificationService;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;

class VerifyComments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'verify:comments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private BannedWordVerificationService $bannedWordVerificationService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(BannedWordVerificationService $bannedWordVerificationService)
    {
        parent::__construct();

        $this->bannedWordVerificationService = $bannedWordVerificationService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $newComments = Comment::where('status', Comment::STATUS_NEW)->get();

        foreach ($newComments as $comment) {
            $verified = $this->bannedWordVerificationService->verify($comment->text);

            $comment->status = $verified ? Comment::STATUS_VERIFIED : Comment::STATUS_SPAM;

            $comment->save();
        }

        return 0;
    }
}
