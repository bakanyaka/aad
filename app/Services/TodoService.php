<?php


namespace App\Services;


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
        $response = $this->client->request('GET', 'users.json');
        $users = (json_decode($response->getBody()))->users;
        return collect($users);
    }

    public function departments()
    {
        $response = $this->client->request('GET', 'custom_fields.json');
        $customFields = (json_decode($response->getBody()))->custom_fields;
        $departments = collect($customFields)->where('name', 'Подразделение')->pluck('possible_values')->flatten()->pluck('value');
        return $departments;
    }

    public function projects()
    {
        $response = $this->client->request('GET', 'projects.json');
        $projects = (json_decode($response->getBody()))->projects;
        return collect($projects);
    }
}