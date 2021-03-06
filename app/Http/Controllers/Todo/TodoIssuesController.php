<?php

namespace App\Http\Controllers\Todo;

use App\Models\Ad\User;
use App\Models\Todo\Issue;
use App\Repositories\IUserRepository;
use App\Services\TodoService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TodoIssuesController extends Controller
{
    protected $adUsers;

    /**
     * TodoIssuesController constructor.
     * @param IUserRepository $userRepository
     */
    public function __construct(IUserRepository $userRepository)
    {
        $this->adUsers = $userRepository;
    }

    public function create(Request $request, TodoService $todoService)
    {
        if ($request->has('username') && empty($request->old('subject')) && empty($request->old('description'))) {
            $user = $this->adUsers->getByAccount($request->username);
            $request->session()->flashInput([
                'subject' => $user->name . ':',
                'description' => $this->generateUserInfoForIssueDesciption($user)
            ]);
        }
        $todoUsers = $todoService->users()->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->firstname . ' ' . $user->lastname
            ];
        });
        $departments = $todoService->departments();
        $projects = $todoService->projects();
        return view('todo/newissue', compact('todoUsers','departments','projects'));
    }

    public function store(Request $request, TodoService $todoService) {
        $this->validate($request, [
           'subject' => 'required',
           'description' => 'required'
        ]);

        $issue = new Issue();
        $issue->projectId = $request->project;
        $issue->trackerId = $request->tracker;
        $issue->assignedToId = $request->assigned_to;
        $issue->priorityId = $request->priority;
        $issue->department = $request->department;
        $issue->subject = $request->subject;
        $issue->description = $request->description;

        $result = $todoService->newIssue($issue);
    }

    private function generateUserInfoForIssueDesciption(User $user) {
        $description = <<<EOT
{$user->name}
{$user->email}
{$user->title}
{$user->cityPhone},{$user->localPhone},{$user->mobilePhone}
EOT;
        return $description;
    }
}
