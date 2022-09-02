<?php

namespace App\Http\Controllers;

use App\Models\TaskCategories;
use App\Models\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TasksController extends Controller
{
    public function index()
    {
        $notAnAdmin = false;

        if (!auth()->user()->hasRole('admin')) {
            $notAnAdmin = true;
        }

        $userTasks = Tasks::select(DB::raw('tasks.*'))
                    ->join('task_categories', 'task_categories.id', 'tasks.category_id')
                    ->join('users', 'users.id', 'tasks.user_id')
                    ->where('task_categories.deleted', '0')
                    ->where('task_categories.status', 'active')
                    ->where('users.status', 'active')
                    ->where('tasks.deleted', '0')
                    ->orderBy('status', 'ASC')
                    ->orderBy('deadline', 'DESC');

        if (!$notAnAdmin) {
            if (request()->name) {
                $userTasks = $userTasks->where('users.name', 'LIKE', '%'.request()->name.'%');
            }
        }

        if (request()->status) {
            $userTasks = $userTasks->where('tasks.status', request()->status);

            if (request()->status == 'overdue') {
                $userTasks = $userTasks->orWhere('tasks.deadline', '<', date("Y-m-d"));
            }
            elseif (request()->status == 'pending') {
                $userTasks = $userTasks->Where('tasks.deadline', '>=', date("Y-m-d"));
            }
        }

        if ($notAnAdmin) {
            $userTasks = $userTasks->where('tasks.user_id', auth()->user()->id);
        }

        $userTasks = $userTasks->paginate(10);

        return view('tasks', compact('userTasks'));
    }

    public function addNewTaskForm()
    {
        $taskCategories = TaskCategories::where('deleted', '0')->where('status', 'active')->orderBy('created_at', 'DESC')->get();

        return view('new-task', compact('taskCategories'));
    }

    public function addNewTask(Request $request)
    {
        $request->validate([
            'title' => 'required|min:2|max:255',
            'category' => 'required|integer|exists:task_categories,id',
            'deadline' => 'required|date',
            'status' => 'required|in:pending,done,overdue'
        ]);

        Tasks::create([
            'title' => $request->title,
            'category_id' => $request->category,
            'deadline' => $request->deadline,
            'status' => $request->status,
            'user_id' => auth()->user()->id,
            'deleted' => '0',
        ]);

        session()->flash('success', 'Task created successfully.');
        return redirect()->to(route('user-tasks'));
    }

    public function editTaskForm($id)
    {
        $notAnAdmin = false;

        if (!auth()->user()->hasRole('admin')) {
            $notAnAdmin = true;
        }

        $task = Tasks::where('id', $id)->where('deleted', '0');

        if ($notAnAdmin) {
            $task = $task->where('user_id', auth()->user()->id);
        }

        $task = $task->first();

        if ($task) {
            $taskCategories = TaskCategories::where('deleted', '0')->where('status', 'active')->orderBy('created_at', 'DESC')->get();

            return view('edit-task', compact('task', 'taskCategories'));
        }
        else {
            session()->flash('error', 'You have made an invalid request. Please try again.');
            return redirect()->to(route('user-tasks'));
        }
    }

    public function editTask(Request $request, $id)
    {
        Tasks::findOrFail($id);

        $request->validate([
            'title' => 'required|min:2|max:255',
            'category' => 'required|integer|exists:task_categories,id',
            'deadline' => 'required|date',
            'status' => 'required|in:pending,done,overdue'
        ]);

        $last_modified_by = 'me';
        $notAnAdmin = true;

        if (auth()->user()->hasRole('admin')) {
            $last_modified_by = 'admin';
            $notAnAdmin = false;
        }

        $findTask = Tasks::where('id', $id)->where('deleted', '0');

        if ($notAnAdmin) {
            $findTask = $findTask->where('user_id', auth()->user()->id);
        }

        $findTask = $findTask->first();

        $findTask->update([
            'title' => $request->title,
            'category_id' => $request->category,
            'deadline' => $request->deadline,
            'status' => $request->status,
            'last_modified_by' => $last_modified_by,
        ]);

        session()->flash('success', 'Task modified successfully.');
        return redirect()->to(route('user-tasks'));
    }

    public function markTaskAsDone($id)
    {
        $notAnAdmin = false;

        if (!auth()->user()->hasRole('admin')) {
            $notAnAdmin = true;
        }

        $findTask = Tasks::where('id', $id)->where('deleted', '0');

        if ($notAnAdmin) {
            $findTask = $findTask->where('user_id', auth()->user()->id);
        }

        $findTask = $findTask->first();

        if ($findTask) {
            $last_modified_by = 'me';
    
            if (!$notAnAdmin) {
                $last_modified_by = 'admin';
            }

            $findTask->status = 'done';
            $findTask->last_modified_by = $last_modified_by;
            $findTask->save();

            session()->flash('success', 'Task marked as done successfully.');
        }
        else {

            session()->flash('error', 'You have made an invalid request. Please try again.');
        }

        return redirect()->to(route('user-tasks'));
    }

    public function unMarkTaskAsDone($id)
    {
        $notAnAdmin = false;

        if (!auth()->user()->hasRole('admin')) {
            $notAnAdmin = true;
        }

        $findTask = Tasks::where('id', $id)->where('deleted', '0');

        if ($notAnAdmin) {
            $findTask = $findTask->where('user_id', auth()->user()->id);
        }

        $findTask = $findTask->first();

        if ($findTask) {
            $last_modified_by = 'me';
    
            if (!$notAnAdmin) {
                $last_modified_by = 'admin';
            }

            $findTask->status = 'pending';
            $findTask->last_modified_by = $last_modified_by;
            $findTask->save();

            session()->flash('success', 'Task un-marked as done successfully.');
        }
        else {

            session()->flash('error', 'You have made an invalid request. Please try again.');
        }

        return redirect()->to(route('user-tasks'));
    }

    public function deleteTask($id)
    {
        $notAnAdmin = false;

        if (!auth()->user()->hasRole('admin')) {
            $notAnAdmin = true;
        }

        $findTask = Tasks::where('id', $id)->where('deleted', '0');

        if ($notAnAdmin) {
            $findTask = $findTask->where('user_id', auth()->user()->id);
        }

        $findTask = $findTask->first();

        if ($findTask) {
            $last_modified_by = 'me';
    
            if (!$notAnAdmin) {
                $last_modified_by = 'admin';
            }

            $findTask->deleted = '1';
            $findTask->last_modified_by = $last_modified_by;
            $findTask->save();

            session()->flash('success', 'Task deleted successfully.');
        }
        else {

            session()->flash('error', 'You have made an invalid request. Please try again.');
        }

        return redirect()->to(route('user-tasks'));
    }
}
