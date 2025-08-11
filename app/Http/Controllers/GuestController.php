<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\EkskulService;
use App\Services\PengumumanService;
use App\Services\RecentActivitiesService;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{
    protected EkskulService $ekskulService;
    protected PengumumanService $pengumumanService;
    protected RecentActivitiesService $recentActivitiesService;
    protected UserService $userService;

    public function __construct(EkskulService $ekskulService, PengumumanService $pengumumanService, RecentActivitiesService $recentActivitiesService, UserService $userService){
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
        if(!$user->ekskuls->isEmpty()){
            foreach($user->ekskuls as $u){
                $idEkskul[] = $u->id;
            }
            $ekskulsUser =  $this->ekskulService->getEkskulByEkskulUser($idEkskul);
        }

        if($bool){
            return !$user->ekskuls->isEmpty() ? response()->json($ekskulsUser) : response()->json();
        }

        return !$user->ekskuls->isEmpty() ?  $ekskulsUser : '';
    }
}