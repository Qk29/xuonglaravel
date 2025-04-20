<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $listCategories = Category::paginate(5);
        return view('admin.categories.index', compact('listCategories'));
    }

    public function addCategory()
    {
        $parentCategories = Category::whereNull('parent_id')->get();
        return view('admin.categories.add', compact('parentCategories'));
    }

    public function handleAddCategory(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
        ]);
        
        
        try {
            Category::create([
                'name' => $request->name,
                
                'description' => $request->description,
                'parent_id' => $request->parent_id,
            ]);

            return redirect()->route('admin.categories.index')->with('message', 'Danh mục đã được thêm thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi khi thêm danh mục: ' . $e->getMessage());
        }
    }

    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        $parentCategories = Category::whereNull('parent_id')
            ->where('id', '!=', $id)
            ->get();
        return view('admin.categories.update', compact('category', 'parentCategories'));
    }

    public function postUpdateCategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            
            'parent_id' => 'nullable|exists:categories,id',
        ],[
            'name.required' => 'Tên danh mục không được để trống.',
            'name.string' => 'Tên danh mục phải là chuỗi.',
            'name.max' => 'Tên danh mục không được vượt quá 255 ký tự.',
            'name.unique' => 'Tên danh mục đã tồn tại.',
            'description.string' => 'Mô tả phải là chuỗi.',
            'description.max' => 'Mô tả không được vượt quá 1000 ký tự.',
            'parent_id.exists' => 'Danh mục cha không hợp lệ.',
        ]);
        try {
            $category = Category::findOrFail($id);
            
            

            $category->update([
                'name' => $request->name,
                
                'description' => $request->description,
                'parent_id' => $request->parent_id,
            ]);

            return redirect()->route('admin.categories.index')->with('message', 'Danh mục đã được cập nhật!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi khi cập nhật danh mục: ' . $e->getMessage());
        }
    }

    public function deleteCategory($id)
    {
        try {
            $category = Category::findOrFail($id);
            
            // Kiểm tra xem có danh mục con không
            $hasChildren = Category::where('parent_id', $id)->exists();
            if ($hasChildren) {
                return redirect()->back()->with('error', 'Không thể xóa danh mục này vì nó có danh mục con!');
            }

            $category->products()->delete();
            
            $category->delete();
            return redirect()->route('admin.categories.index')->with('message', 'Danh mục đã được xóa.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi khi xóa danh mục: ' . $e->getMessage());
        }
    }
}
