<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function messages()
    {
        return [
            'name.required' => 'Tên người dùng là bắt buộc',
            'name.string' => 'Tên người dùng phải là chuỗi',
            'name.max' => 'Tên người dùng không được vượt quá 255 ký tự',
            'email.required' => 'Email là bắt buộc',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Mật khẩu là bắt buộc',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'phone.required' => 'Số điện thoại là bắt buộc',
            'phone.string' => 'Số điện thoại phải là chuỗi',
            'address.required' => 'Địa chỉ là bắt buộc',
            'address.string' => 'Địa chỉ phải là chuỗi',
            'status.required' => 'Trạng thái là bắt buộc',
            'status.in' => 'Trạng thái không hợp lệ',
            'avatar.required' => 'Ảnh đại diện là bắt buộc',
            'avatar.image' => 'File phải là ảnh',
            'avatar.mimes' => 'Ảnh phải có định dạng: jpeg, png, jpg, gif',
            'avatar.max' => 'Kích thước ảnh không được vượt quá 2MB',
        ];
    }

    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10);
        $isAll = false;
        if ($perPage == 'all') {
            $listUsers = User::all();
            $isAll = true;
        } else {
            $perPage = (int) $perPage > 0 ? (int) $perPage : 10;
            $listUsers = User::paginate($perPage)->withQueryString();
        }
        return view('admin.users.index', compact('listUsers', 'perPage', 'isAll'));
    }

    

    

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.update', compact('user'));
    }

    public function postUpdateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $validationRules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|string',
            'address' => 'required|string',
            'status' => 'required|in:0,1',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
        
        // Only validate password if it's provided
        if ($request->filled('password')) {
            $validationRules['password'] = 'min:6';
        }
        
        $request->validate($validationRules, $this->messages());
        
        $imagePath = $user->avatar; // Giữ nguyên đường dẫn ảnh cũ

        if ($request->hasFile('avatar')) {
            try {
                // Kiểm tra và xóa ảnh cũ nếu tồn tại
                if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }

                // Upload ảnh mới
                $image = $request->file('avatar');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = 'users/' . $imageName;

                // Lưu file ảnh mới vào disk 'public'
                $image->storeAs('users', $imageName, 'public');
                
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Lỗi khi upload ảnh: ' . $e->getMessage());
            }
        }

        try {
            // Cập nhật dữ liệu người dùng
            $updateData = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'status' => $request->status,
                'avatar' => $imagePath,
            ];
            
            // Only update password if it's provided
            if ($request->filled('password')) {
                $updateData['password'] = Hash::make($request->password);
            }
            
            $user->update($updateData);

            return redirect()->route('admin.users.index')->with('message', 'Người dùng đã được cập nhật!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi khi cập nhật người dùng: ' . $e->getMessage());
        }
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        if ($user->role === '1') {
            return redirect()->back()->with('error', 'Không thể xoá tài khoản admin.');
        }
        if ($user->avatar) {
            $imagePath = public_path('storage/' . $user->avatar);
            if (file_exists($imagePath)) {
                unlink($imagePath); // Xóa file ảnh
            }
        }

        $user->delete(); // Thực hiện soft delete
        return redirect()->route('admin.users.index')->with('message', 'Người dùng đã được xóa.');
    }
}
