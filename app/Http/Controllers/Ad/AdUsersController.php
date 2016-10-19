<?php

namespace App\Http\Controllers\Ad;

use App\Http\Controllers\Controller;
use App\Repositories\IUserRepository;
use App\Services\SearchService;
use Illuminate\Http\Request;

class AdUsersController extends Controller
{
    protected $search;

    /**
     * AdUsersController constructor.
     * @param SearchService $searchService
     */
    public function __construct(SearchService $searchService)
    {
        $this->search = $searchService;
    }

    public function index()
    {
        return view('ad.users.index');
    }

    public function search(Request $request){
        if ($request->has('q')) {
            $result = $this->search ->findUser(trim($request->q));
            return response()->json($result);
        }
        return response()->json();
    }
}
