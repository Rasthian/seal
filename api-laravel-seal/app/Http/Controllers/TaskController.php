<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function createTask(Request $request)
    {
        $status = '';
        $message = '';
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in progress,completed', 
            'project_id' => 'required|exists:projects,id_project', 
            'user_id' => 'required|exists:users,id_user', 
        ]);

        try {
            $newProject = Task::create([
                'name' => $request->name,
                'description' => $request->description,
                'status' => $request->status,
                'project_id' => $request->project_id,
                'user_id' => $request->user_id,
            ]);

            if ($newProject) {
                $message = 'Berhasil menambah data Tugas';
                $status_code = 201;
            } else {
                $message = 'Gagal menambah data Tugas';
                $status_code = 400;
            }

            $status = 'success';
            $data = $newProject;
        } catch (\Exception $e) {
            $status = 'failed';
            $message = 'Gagal menjalankan request: ' . $e->getMessage();
            $status_code = 500;
            $data = null;
        } finally {
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $data
            ], $status_code);
        }
    }
    public function getProject()
    {
        $status = '';
        $message = '';
        try {
            $projects = Task::all();
            if ($projects) {
                $message = 'Berhasil mengambil data Tugas';
                $status_code = 201;
            } else {
                $message = 'Gagal mengambil data Tugas';
                $status_code = 400;
            }
            $status = 'success';
            $data = $projects;
        } catch (\Exception $e) {
            $status = 'failed';
            $message = 'gagal menjalankan request: ' . $e->getMessage();
            $status_code = 500;
            $data = null;
        } finally {
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $data,
            ], $status_code);
        }
    }
    public function deleteProject($id)
    {
        $status = '';
        $message = '';

        try {
            $project = Task::find($id);

            if ($project) {
                $project->delete();
                $status = 'success';
                $message = 'Berhasil menghapus data Tugas';
                $status_code = 200;
                $data = null;
            } else {
                $status = 'failed';
                $message = 'Tugas tidak ditemukan';
                $status_code = 404;
                $data = null;
            }
        } catch (\Exception $e) {
            $status = 'failed';
            $message = 'Gagal menjalankan request: ' . $e->getMessage();
            $status_code = 500;
            $data = null;
        } finally {
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $data,
            ], $status_code);
        }
    }
}
