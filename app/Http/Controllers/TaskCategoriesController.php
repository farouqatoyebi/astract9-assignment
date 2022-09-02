<?php

namespace App\Http\Controllers;

use App\Models\TaskCategories;
use Illuminate\Http\Request;

class TaskCategoriesController extends Controller
{
    public function index()
    {
        $taskCategories = TaskCategories::where('deleted', '0')->orderBy('created_at', 'DESC')->paginate(10);

        return view('task-categories', compact('taskCategories'));
    }

    public function addTaskCategoryForm()
    {
        return view('new-task-category');
    }

    public function addTaskCategory(Request $request)
    {
        $request->validate([
            'title' => 'required|min:2|max:255|unique:task_categories,title',
            'status' => 'required|min:2|max:255',
        ], [
            'title.unique' => 'This title already exists'
        ]);

        TaskCategories::create([
            'title' => $request->title,
            'status' => $request->status,
            'deleted' => '0',
        ]);

        session()->flash('success', 'Task Category created successfully.');
        return redirect()->to(route('admin-task-categories'));
    }

    public function editTaskCategoryForm($id)
    {
        $taskCategory = TaskCategories::where('id', $id)->where('deleted', '0')->first();

        if ($taskCategory) {
            return view('edit-task-category', compact('taskCategory'));
        }
        else {
            session()->flash('error', 'You have made an invalid request. Please try again.');
            return redirect()->to(route('admin-task-categories'));
        }
    }

    public function editTaskCategory(Request $request, $id)
    {
        TaskCategories::findOrFail($id);

        $request->validate([
            'status' => 'required|min:2|max:255',
        ]);

        TaskCategories::where('id', $id)->update([
            'status' => $request->status,
        ]);

        session()->flash('success', 'Task Category modified successfully.');
        return redirect()->to(route('admin-task-categories'));
    }

    public function deleteTaskCategory($id)
    {
        $findTaskCategory = TaskCategories::where('id', $id)->where('deleted', '0')->first();

        if ($findTaskCategory) {
            $findTaskCategory->title = time().'__'.strtolower($findTaskCategory->title);
            $findTaskCategory->deleted = '1';
            $findTaskCategory->save();

            session()->flash('success', 'Task Category deleted successfully.');
        }
        else {

            session()->flash('error', 'You have made an invalid request. Please try again.');
        }

        return redirect()->to(route('admin-task-categories'));
    }
}
