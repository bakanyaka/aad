<?php

namespace App\Http\Controllers\Ad;

use App\Http\Controllers\Controller;
use App\Repositories\IUserRepository;
use Illuminate\Http\Request;

class AdUsersController extends Controller
{
    /**
     * @var IUserRepository
     */
    protected $users;

    /**
     * AdUsersController constructor.
     * @param IUserRepository $userRepo
     */
    public function __construct(IUserRepository $userRepo)
    {
        $this->users = $userRepo;
    }

    public function index()
    {
        return view('ad.users.index');
    }

    public function search(Request $request){
        if (!empty($request->input('name'))) {
            $result = $this->users->findByName($request->input('name'));
            return response()->json($result);
        }
        return response()->json();
    }
}
