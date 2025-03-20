## Quy trình chạy dự án

**Bước 1:**
Clone dự án từ github về

```bash
    git clone https://github.com/Qk29/xuonglaravel.git
```

**Bước 2:**
Cài đặt toàn bộ thư viện JS

```bash
# Cài đặt nodemodules
npm i
```

**Bước 3:**

Cài đặt toàn bộ thư viện PHP

```bash
# create vendor folder
    composer update
```

**Bước 4:**
Tạo file `.env`

-   copy file `.env.example` => `.env`
-   Cấu hình file vừa tạo `.env`

**Bước 5:**

Build CS, JS qua public

```bash
    npm run build
```

**Bước 6:**
Tạo DB và tạo bảng trong DB

```bash
    php artisan migrate
```

**Bước 7:**
Tạo dữ liệu mẫu

```bash
    php artisan db:seed
```

**Bước 8:**
Generate Key

```bash
    php artisan key:generate
```

**Bước 9:**
Khởi chạy dự án

-   Cách 1:

```bash
    composer run dev
```
