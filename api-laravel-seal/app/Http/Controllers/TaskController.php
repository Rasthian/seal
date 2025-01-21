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
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'status' => 'required|string',
                'project_id' => 'required|exists:projects,id_project',
                'user_id' => 'required|exists:users,id_user',
            ]);

            $task = Task::create($validatedData);

            $status = 'success';
            $message = 'Tugas berhasil dibuat';
            $status_code = 201;
            $data = $task;
        } catch (\Exception $e) {
            $status = 'failed';
            $message = 'Gagal membuat tugas: ' . $e->getMessage();
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

    public function getTask()
    {
        $status = '';
        $message = '';
        try {
            $tasks = Task::all();
            if ($tasks) {
                $message = 'Berhasil mengambil data Tugas';
                $status_code = 201;
            } else {
                $message = 'Gagal mengambil data Tugas';
                $status_code = 400;
            }
            $status = 'success';
            $data = $tasks;
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

    public function deleteTask($id_task)
    {
        $status = '';
        $message = '';
        try {
            $task = Task::find($id_task);

            if (!$task) {
                $status = 'failed';
                $message = 'Tugas tidak ditemukan';
                $status_code = 404;
                $data = null;
            } else {
                $task->delete();

                $status = 'success';
                $message = 'Tugas berhasil dihapus';
                $status_code = 200;
                $data = null;
            }
        } catch (\Exception $e) {
            $status = 'failed';
            $message = 'Gagal menghapus tugas: ' . $e->getMessage();
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
