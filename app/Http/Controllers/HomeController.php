<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $notAnAdmin = false;

        if (!auth()->user()->hasRole('admin')) {
            $notAnAdmin = true;
        }

        if (auth()->user()->status != 'active') {
            session()->flush();

            session()->flash('error', 'Your account is no longer active. Contact an Administrator if you think this is an error.');
            return redirect()->to(route('login'));
        }

        $allTasks = Tasks::select(DB::raw('tasks.status, tasks.deadline'))
                    ->join('task_categories', 'task_categories.id', 'tasks.category_id')
                    ->join('users', 'users.id', 'tasks.user_id')
                    ->where('task_categories.deleted', '0')
                    ->where('task_categories.status', 'active')
                    ->where('users.status', 'active')
                    ->where('tasks.deleted', '0');

        if ($notAnAdmin) {
            $allTasks = $allTasks->where('tasks.user_id', auth()->user()->id);
        }

        $allTasks = $allTasks->get();


        $lastFiveTasks = Tasks::select(DB::raw('tasks.*'))
                    ->join('task_categories', 'task_categories.id', 'tasks.category_id')
                    ->join('users', 'users.id', 'tasks.user_id')
                    ->where('task_categories.deleted', '0')
                    ->where('task_categories.status', 'active')
                    ->where('users.status', 'active')
                    ->where('tasks.deleted', '0')
                    ->orderBy('created_at', 'DESC')
                    ->limit(5);

        if ($notAnAdmin) {
            $lastFiveTasks = $lastFiveTasks->where('tasks.user_id', auth()->user()->id);
        }

        $lastFiveTasks = $lastFiveTasks->get();

        $totalTasks = 0;
        $totalPendingTasks = 0;
        $totalOverDueTasks = 0;
        $totalDoneTasks = 0;

        $totalUsers = 0;
        $totalActiveUsers = 0;
        $totalSuspendedUsers = 0;
        $totalPendingUsers = 0;

        if (count($allTasks->all())) {
            foreach ($allTasks as $key => $userTask) {
                $totalTasks++;

                if ($userTask->status == 'done') {
                    $totalDoneTasks++;
                }
                elseif ($userTask->status == 'pending') {
                    if ($userTask->deadline < date("Y-m-d")) {
                        // dd($userTask->deadline);
                         $totalOverDueTasks++;
                    }
                    else {
                        $totalPendingTasks++;
                    }
                }
                elseif ($userTask->status == 'overdue') {
                    $totalOverDueTasks++;
                }
            }
        }

        if (!$notAnAdmin) {
            $totalUsers = User::where('status', '<>', 'deleted')->role('user')->count();
            $totalActiveUsers = User::where('status', 'active')->role('user')->count();
            $totalSuspendedUsers = User::where('status', 'suspended')->role('user')->count();
            $totalPendingUsers = User::where('status', 'pending')->role('user')->count();

            $lastFiveUsers = User::role('user')->limit(5)->orderBy('created_at', 'DESC')->get();
        }
        else {
            $lastFiveUsers = User::role('user')->where('id', auth()->user()->id)->limit(5)->orderBy('created_at', 'DESC')->get();
        }

        $data = [
            'totalTasks' => $totalTasks,
            'totalPendingTasks' => $totalPendingTasks,
            'totalOverDueTasks' => $totalOverDueTasks,
            'totalDoneTasks' => $totalDoneTasks,
        ];

        if (!$notAnAdmin) {
            $data['totalUsers']  = $totalUsers;
            $data['totalActiveUsers'] = $totalActiveUsers;
            $data['totalSuspendedUsers'] = $totalSuspendedUsers;
            $data['totalPendingUsers'] = $totalPendingUsers;
        }

        return view('home', compact('data', 'lastFiveTasks', 'lastFiveUsers'));
    }

    public function allUsers(Request $request)
    {
        $status = $request->status;
        $users = User::role('user')->orderBy('created_at', 'DESC');

        if ($status) {
            $users = $users->where('status', trim($status));
        }

        $users = $users->paginate(10);

        return view('users', compact('users'));
    }

    public function activateUser(Request $request, $id)
    {
        $getUser = User::where('id', $id)->role('user')->first();

        if ($getUser) {
            $getUser->status = 'active';
            $getUser->save();

            session()->flash('success', 'User\'s account has been activated successfully.');
            return redirect()->back();
        }

        session()->flash('error', 'We could not complete your request at this time. Please try again.');
        return redirect()->back();
    }

    public function suspendUser(Request $request, $id)
    {
        $getUser = User::where('id', $id)->role('user')->first();

        if ($getUser) {
            $getUser->status = 'suspended';
            $getUser->save();

            session()->flash('success', 'User\'s account has been suspended successfully.');
            return redirect()->back();
        }

        session()->flash('error', 'We could not complete your request at this time. Please try again.');
        return redirect()->back();
    }
}
