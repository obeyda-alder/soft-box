<?php

namespace App\Http\Controllers\BackEnd\Users;

use Exception;
use App\Models\User;
use App\Helpers\ImageHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
  public function index(Request $request)
  {
    $type = '';
    if (isset($request->type)) {
      $type = $request->type;
    }

    return view('backEnd.content.users.index', compact('type'));
  }

  public function dataTable(Request $request)
  {
    $users = User::withTrashed();
    if (isset($request->type)) {
      $users->where('type', $request->type);
    }
    $users->get();

    return Datatables::of($users)
      ->addColumn('image', function ($user) {
        return $user->image;
      })
      ->addColumn('id', function ($user) {
        return $user->id;
      })
      ->addColumn('name', function ($user) {
        return $user->name;
      })
      ->addColumn('email', function ($user) {
        return $user->email;
      })
      ->addColumn('type', function ($user) {
        return $user->type;
      })
      ->addColumn('created_at', function ($user) {
        return $user->created_at;
      })
      ->addColumn('actions', function ($user) {
        $actions = [];
        if (auth()->user()->type == "ADMIN") {
          if (!$user->trashed()) {
            $actions[] = [
              'id'            => $user->id,
              'label'         => __('admin.edit'),
              'link'          => route('admin:users:show', ['user' => $user]),
              'method'        => 'GET',
              'type'          => 'icon',
              'class'         => 'edit-icons',
              'action'        => 'edit',
              'icon'          => 'bx bxs-edit'
            ];
            $actions[] = [
              'id'            => $user->id,
              'label'         => __('admin.delete'),
              'link'          => route('admin:users:delete', ['user' => $user->id]),
              'method'        => 'DELETE',
              'type'          => 'icon',
              'class'         => 'edit-icons',
              'action'        => 'softDelete',
              'icon'          => 'bx bxs-trash'
            ];
          } else {
            $actions[] = [
              'id'            => $user->id,
              'label'         => __('admin.restore'),
              'link'          => route('admin:users:restore', ['user' => $user->id]),
              'method'        => 'PUT',
              'type'          => 'icon',
              'class'         => 'restore-icons',
              'action'        => 'restore',
              'icon'          => 'bx bx-refresh'
            ];
            $actions[] = [
              'id'            => $user->id,
              'label'         => __('admin.destroy'),
              'link'          => route('admin:users:destroy', ['user' => $user->id]),
              'method'        => 'DELETE',
              'type'          => 'icon',
              'class'         => 'destroy-icons',
              'action'        => 'destroy',
              'icon'          => 'bx bxs-trash-alt'
            ];
          }
        }
        return $actions;
      })
      ->make(true);
  }

  public function create(Request $request, $type)
  {
    return view('backEnd.content.users.create', compact('type'));
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name'        => 'required|string|max:255',
      'email'       => 'required|email|max:255|unique:users',
      'password'    => 'required|string|min:8',
      'phone'       => 'required|string|min:8',
      'type'        => 'required|string|in:' . implode(",", config('variables.type')),
      'status'      => 'required|string|in:' . implode(",", config('variables.status')),
      'user_image'  => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",

    ]);

    if ($validator->fails()) {
      $toReturn['message']               = 'fail';
      $messages = $validator->messages()->toArray();
      foreach ($messages as $key => $value) {
        $toReturn['errors'][$key] = $value[0];
      }
      return response()->json($toReturn, 200);
    }

    try {
      $user                = new User;
      $user->name          = $request->name;
      $user->email         = $request->email;
      $user->password      = $request->password;
      $user->type          = $request->type;
      $user->phone_number  = $request->phone;
      $user->status        = $request->status;

      if ($request->hasFile('user_image')) {
        $user->image = ImageHelper::UploadWithResizeImage($request->file('user_image'), 'users');
      }

      $user->save();

      return response()->json([
        'success' => true,
        'message' => 'successfully saved',
        'redirect_url'  => route('admin:users', ['type' => $request->type])
      ], 200);
    } catch (Exception $e) {
      return response()->json([
        'error' => $e->getMessage(),
        'message' => 'you hava some error'
      ], 401);
    }
  }

  public function show(Request $request, User $user)
  {
    return view('backEnd.content.users.edit', compact('user'));
  }

  public function edit(Request $request, User $user)
  {
    $validator = Validator::make($request->all(), [
      'name'        => 'required|string|max:255',
      'email'       => 'required|email|max:255|unique:users,id,' . $user->id,
      'password'    => 'nullable|string|min:8',
      'phone'       => 'required|string|min:8',
      'type'        => 'required|string|in:' . implode(",", config('variables.type')),
      'status'      => 'required|string|in:' . implode(",", config('variables.status')),
      'user_image'  => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",

    ]);

    if ($validator->fails()) {
      $toReturn['message']               = 'fail';
      $messages = $validator->messages()->toArray();
      foreach ($messages as $key => $value) {
        $toReturn['errors'][$key] = $value[0];
      }
      return response()->json($toReturn, 200);
    }

    try {
      $user                = User::findOrFail($user->id);
      $user->name          = $request->name;
      $user->email         = $request->email;
      $user->phone_number  = $request->phone;
      $user->type          = $request->type;
      $user->status        = $request->status;

      if ($request->has('password')) {
        $user->password      = $request->password;
      }

      if ($request->hasFile('user_image')) {
        ImageHelper::deleteImg('users', $user->getRawOriginal('image'));
        $user->image = ImageHelper::UploadWithResizeImage($request->file('user_image'), 'users');
      }

      $user->save();

      return response()->json([
        'success' => true,
        'message' => 'successfully saved',
        'redirect_url'  => route('admin:users', ['type' => $request->type])
      ], 200);
    } catch (Exception $e) {
      return response()->json([
        'error' => $e->getMessage(),
        'message' => 'you hava some error'
      ], 401);
    }
  }

  public function delete($user)
  {
    try {
      $user = User::withTrashed()->findOrFail($user);
      $user->delete();
    } catch (Exception $e) {
      return response()->json([
        'error' => $e->getMessage(),
        'message' => 'you hava some error'
      ], 401);
    }
  }

  public function restore($user)
  {
    try {
      $user = User::withTrashed()->findOrFail($user);
      $user->restore();
    } catch (Exception $e) {
      return response()->json([
        'error' => $e->getMessage(),
        'message' => 'you hava some error'
      ], 401);
    }
  }

  public function destroy($user)
  {
    try {
      $user = User::withTrashed()->findOrFail($user);
      $user->forceDelete();
      ImageHelper::deleteImg('users', $user->getRawOriginal('image'));
    } catch (Exception $e) {
      return response()->json([
        'error' => $e->getMessage(),
        'message' => 'you hava some error'
      ], 401);
    }
  }
}
