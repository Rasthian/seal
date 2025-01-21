<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function createProject(Request $request)
    {
        $status = '';
        $message = '';
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        try {
            $newProject = Project::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            if ($newProject) {
                $message = 'Berhasil menambah data proyek';
                $status_code = 201;
            } else {
                $message = 'Gagal menambah data proyek';
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
            $projects = Project::all();
            if ($projects) {
                $message = 'Berhasil mengambil data proyek';
                $status_code = 201;
            } else {
                $message = 'Gagal mengambil data proyek';
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

    public function deleteProject($id_project)
    {
        $status = '';
        $message = '';

        try {
            $project = Project::find($id_project);

            if ($project) {
                $project->delete();
                $status = 'success';
                $message = 'Berhasil menghapus data proyek';
                $status_code = 200;
                $data = null;
            } else {
                $status = 'failed';
                $message = 'Proyek tidak ditemukan';
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
    public function updateProject(Request $request, $id_project)
    {
        $status = '';
        $message = '';

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        try {
            $project = Project::find($id_project);

            if ($project) {
                $project->update([
                    'name' => $request->name,
                    'description' => $request->description,
                ]);

                $status = 'success';
                $message = 'Berhasil memperbarui data proyek';
                $status_code = 200;
                $data = $project;
            } else {
                $status = 'failed';
                $message = 'Proyek tidak ditemukan';
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
