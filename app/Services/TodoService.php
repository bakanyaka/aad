<?php


namespace App\Services;


use App\Models\Todo\Issue;
use GuzzleHttp\Client;


class TodoService
{

    private $client;

    /**
     * TodoService constructor.
     * @param Client $httpClient
     */
    public function __construct(Client $httpClient)
    {
        $this->client = $httpClient;
    }

    public function users()
    {
        $response = $this->client->request('GET', 'users.json',['query' => ['limit' => '100']]);
        $users = (json_decode($response->getBody()))->users;
        return collect($users);
    }

    public function departments()
    {
        $response = $this->client->request('GET', 'custom_fields.json');
        $customFields = (json_decode($response->getBody()))->custom_fields;
        $departments = collect($customFields)->where('name', 'Подразделение')->
        pluck('possible_values')->flatten()->map(function ($item) {
            $department = new \stdClass();
            $department->name = $item->value;
            $department->id = explode('  ', $item->value)[0];
            return $department;
        });
        return $departments;
    }

    public function projects()
    {
        $response = $this->client->request('GET', 'projects.json');
        $projects = (json_decode($response->getBody()))->projects;
        return collect($projects);
    }

    public function newIssue(Issue $issue) {
        $postData = [
            'issue' => [
                'project_id' => $issue->projectId,
                'tracker_id' => $issue->trackerId,
                'subject' => $issue->subject,
                'description' => $issue->description,
                'assigned_to_id' => $issue->assignedToId,
                'custom_fields' => [
                    [
                        'id' => 1,
                        'value' => $issue->department
                    ]
                ]
            ]
        ];
        $response = $this->client->request('POST', 'issues.json', ['json' => $postData]);
        dd($response);
    }
}