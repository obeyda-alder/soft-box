<?php

namespace App\Http\Controllers\BackEnd\Users;

use App\Models\User;
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
              'link'          => route('admin:users:edit', ['user' => $user]),
              'method'        => 'GET',
              'type'          => 'icon',
              'class'         => 'edit-icons',
              'action'        => 'edit',
              'icon'          => 'bx bxs-edit'
            ];
            $actions[] = [
              'id'            => $user->id,
              'label'         => __('admin.delete'),
              'link'          => route('admin:users:delete', ['user' => $user]),
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
              'link'          => route('admin:users:restore', ['user' => $user]),
              'method'        => 'PUT',
              'type'          => 'icon',
              'class'         => 'restore-icons',
              'action'        => 'restore',
              'icon'          => 'bx bx-refresh'
            ];
            $actions[] = [
              'id'            => $user->id,
              'label'         => __('admin.destroy'),
              'link'          => route('admin:users:destroy', ['user' => $user]),
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

  public function store(Request $request, $type)
  {
    $validator = Validator::make($request->all(), [
      'name'      => 'required|string|max:255',
      'email'     => 'required|email|max:255|unique:users',
      'password'  => 'required|string|min:8',
    ]);

    if ($validator->fails()) {
      $toReturn['message']               = 'fail';
      $messages = $validator->messages()->toArray();
      foreach ($messages as $key => $value) {
        $toReturn['errors'][$key] = $value[0];
      }
      return response()->json($toReturn, 200);
    }
  }

  public function show(Request $request, User $user)
  {
  }
  public function edit(Request $request, User $user)
  {
    return view('backEnd.content.users.edit', compact('user'));
  }
  public function delete(Request $request, User $user)
  {
  }
  public function restore(Request $request, User $user)
  {
  }
  public function destroy(Request $request, User $user)
  {
  }

  // public function create($user)
  // {
  //   try {
  //     $create_user               = new User;
  //     $create_user->first_name   = $user['first_name'];
  //     $create_user->last_name    = $user['last_name'];
  //     $create_user->email        = $user['email'];
  //     $create_user->status       = $user['status'];
  //     $create_user->phone_number = $user['phone_number'];
  //     $create_user->password     = $user['password'];
  //     $create_user->type         = $user['type'];

  //     if (!empty($user['image'])) {
  //       $create_user->image = ImageHelper::UploadWithResizeImage($user['image'], 'users', ImageSize::USERS);
  //     }

  //     $create_user->assignRole($user['role']);
  //     $create_user->save();
  //     return $create_user;
  //   } catch (Exception $e) {
  //     return response()->json([
  //       'error' => $e->getMessage(),
  //       'message' => 'you hava some error'
  //     ], 401);
  //   }
  // }

  // public function findById($id)
  // {
  //   try {
  //     return User::withTrashed()->findOrFail($id);
  //   } catch (Exception $e) {
  //     return response()->json([
  //       'error' => $e->getMessage(),
  //       'message' => 'you hava some error'
  //     ], 401);
  //   }
  // }

  // public function update($data, int $user)
  // {
  //   try {
  //     $update_user               = $this->findById($user);
  //     $update_user->first_name   = $data['first_name'];
  //     $update_user->last_name    = $data['last_name'];
  //     $update_user->email        = $data['email'];
  //     $update_user->status       = $data['status'];
  //     $update_user->phone_number = $data['phone_number'];
  //     $update_user->type         = $data['type'];

  //     if (isset($data['password'])) {
  //       $update_user->password = $data['password'];
  //     }

  //     if (!empty($data['image'])) {
  //       ImageHelper::deleteImg('users', $update_user->getRawOriginal('image'), ImageSize::USERS);
  //       $update_user->image = ImageHelper::UploadWithResizeImage($data['image'], 'users', ImageSize::USERS);
  //     }

  //     $update_user->syncRoles($data['role']);
  //     $update_user->save();
  //     return $update_user;
  //   } catch (Exception $e) {
  //     return response()->json([
  //       'error' => $e->getMessage(),
  //       'message' => 'you hava some error'
  //     ], 401);
  //   }
  // }

  // public function softDelete($user)
  // {
  //   try {
  //     $user = $this->findById($user);
  //     $user->delete();
  //   } catch (Exception $e) {
  //     return response()->json([
  //       'error' => $e->getMessage(),
  //       'message' => 'you hava some error'
  //     ], 401);
  //   }
  // }

  // public function restore($user)
  // {
  //   try {
  //     $user = $this->findById($user);
  //     $user->restore();
  //   } catch (Exception $e) {
  //     return response()->json([
  //       'error' => $e->getMessage(),
  //       'message' => 'you hava some error'
  //     ], 401);
  //   }
  // }

  // public function destroy($user)
  // {
  //   try {
  //     $user = $this->findById($user);
  //     $user->forceDelete();
  //     ImageHelper::deleteImg('users', $user->getRawOriginal('image'), ImageSize::USERS);
  //   } catch (Exception $e) {
  //     return response()->json([
  //       'error' => $e->getMessage(),
  //       'message' => 'you hava some error'
  //     ], 401);
  //   }
  // }
}