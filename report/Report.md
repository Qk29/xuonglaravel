
# 📘 BÁO CÁO TỔNG KẾT KIẾN THỨC ĐÃ HỌC

## 🔰 1. Route - Controller - View
- Hiểu cách Laravel xử lý route: nhận request → gọi controller → trả về view.
- Biết tạo route đơn giản, route có tham số, route nhóm (`Route::group()`).
- Biết tạo controller bằng lệnh `php artisan make:controller`.
- Biết kết nối controller với view để hiển thị dữ liệu.

## 🗃 2. Migration - Seeder - Factory
- Biết tạo migration để tạo bảng trong database.
- Biết dùng `php artisan migrate`, `rollback`, `refresh` để điều chỉnh bảng.
- Dùng seeder để tạo dữ liệu mẫu nhanh (`DB::table()->insert()` hoặc model).
- Dùng factory để tự động sinh dữ liệu giả (fake) với thư viện Faker.

## 📄 3. Query Builder
- Sử dụng cú pháp đơn giản để truy vấn CSDL.
- Các câu lệnh thường dùng: `select()`, `where()`, `orderBy()`, `limit()`, `join()`.
- Tránh dùng SQL thuần, tăng tính bảo mật và dễ bảo trì code.

## 🧪 4. Validate (Xác thực dữ liệu)
- Sử dụng `validate()` trong controller để kiểm tra dữ liệu đầu vào.
- Có thể tự định nghĩa rule hoặc dùng sẵn như: `required`, `email`, `min`, `max`...
- Hiển thị lỗi trong view bằng biến `$errors`.

## 🔄 5. Soft Delete & Storage
- Biết dùng `softDeletes()` trong migration để không xóa dữ liệu thật sự.
- Model cần dùng `use SoftDeletes;`.
- Quản lý file bằng Storage: lưu ảnh, đọc/ghi file thông qua `Storage::put()`, `get()`...

## 🔗 6. RESTful API
- Hiểu khái niệm về API và cách Laravel tổ chức các route dạng RESTful (GET, POST, PUT, DELETE).
- Biết dùng Postman để test API.
- Controller dạng `resource` hỗ trợ đầy đủ 7 phương thức chuẩn.

## 🧠 7. Bài học & Cảm nhận
- Qua khoá học, em đã hiểu rõ cách Laravel tổ chức code theo MVC.
- Ban đầu hơi khó tiếp cận với Artisan CLI và các cú pháp mới, nhưng khi thực hành nhiều thì thấy rất tiện.
- Em tự tin có thể làm một project CRUD đơn giản và biết cách tiếp cận những chức năng nâng cao hơn sau này.
