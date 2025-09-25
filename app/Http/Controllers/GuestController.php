<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\EkskulService;
use App\Services\PengumumanService;
use App\Services\ActivitiesService;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{
    protected EkskulService $ekskulService;
    protected PengumumanService $pengumumanService;
    protected ActivitiesService $recentActivitiesService;
    protected UserService $userService;

    public function __construct(EkskulService $ekskulService, PengumumanService $pengumumanService, ActivitiesService $recentActivitiesService, UserService $userService){
        $this->ekskulService = $ekskulService;
        $this->pengumumanService = $pengumumanService;
        $this->recentActivitiesService = $recentActivitiesService;
        $this->userService = $userService;
    }

    public function index(){
        $ekskuls = $this->ekskulService->getAllWithCount();
        $announcements = $this->pengumumanService->getAll();
        $recentActivities = $this->recentActivitiesService->getAll();
        $user = Auth::user() ? $this->userService->getUserWithEkskul() : '';
        $userWithEkskulApproved = Auth::user() ? $this->userService->getUserWithEkskulApproved() : '';
        $ekskulsUser = $user ?  $this->getUserEkskul(false): '';


        return view('guest.dashboard.index', compact('ekskuls', 'announcements', 'recentActivities', 'user', 'ekskulsUser', 'userWithEkskulApproved'));
    }


    public function getUserEkskul($bool)
    {
        $user = $this->userService->getUserWithEkskul();
        $conditionUser = $user->role == "pembina" ? $user->ekskulDibina : $user->ekskuls;
        if(!$conditionUser->isEmpty()){
            foreach($conditionUser as $u){
                $idEkskul[] = $u->id;
            }
            $ekskulsUser =  $this->ekskulService->getEkskulByEkskulUser($idEkskul);
        }

        if($bool){
            return !$conditionUser->isEmpty() ? response()->json($ekskulsUser) : response()->json();
        }

        return !$conditionUser->isEmpty() ?  $ekskulsUser : '';
    }
}