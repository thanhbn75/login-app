# Họ tên: Vũ Minh Thành

# Mã sinh viên: 23810310236

# Lớp: D18CNPM2

---

# 📌 Giới thiệu

Dự án xây dựng chức năng đăng nhập bằng tài khoản bên thứ ba (Google và Facebook) sử dụng Laravel và Socialite (OAuth 2.0).

---

# ⚙️ 1. Cách cài đặt

## 🔧 Yêu cầu hệ thống

* PHP >= 8.x
* Composer
* MySQL (XAMPP)
* Node.js (nếu dùng frontend nâng cao)

---

## 🚀 Cài đặt project

### Bước 1: Clone project

```bash
git clone <link-github>
cd login-app
```

### Bước 2: Cài thư viện

```bash
composer install
```

### Bước 3: Tạo file môi trường

```bash
cp .env.example .env
```

### Bước 4: Cấu hình database

Mở file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=social_login
DB_USERNAME=root
DB_PASSWORD=
```

Tạo database:

```sql
CREATE DATABASE social_login;
```

---

### Bước 5: Generate key

```bash
php artisan key:generate
```

---

### Bước 6: Chạy migration

```bash
php artisan migrate
```

---

### Bước 7: Chạy project

```bash
php artisan serve
```

Truy cập:

```
http://127.0.0.1:8000
```

---

# 🔐 2. Cấu hình Google OAuth

## Bước 1: Tạo ứng dụng Google

* Truy cập: https://console.cloud.google.com
* Tạo Project
* Vào **OAuth Consent Screen** → cấu hình
* Vào **Credentials** → Create OAuth Client ID

---

## Bước 2: Cấu hình Redirect URI

```
http://127.0.0.1:8000/auth/google/callback
```

---

## Bước 3: Lấy thông tin

* Client ID
* Client Secret

---

## Bước 4: Cập nhật `.env`

```env
GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_REDIRECT_URI=http://127.0.0.1:8000/auth/google/callback
```

---

# 📘 3. Cấu hình Facebook OAuth

## 🔐 Cấu hình Facebook OAuth với ngrok (HTTPS)

Do Facebook yêu cầu HTTPS khi đăng nhập OAuth, cần sử dụng ngrok để tạo URL bảo mật.

### Bước 1: Cài đặt ngrok

Tải tại: https://ngrok.com/download

### Bước 2: Kết nối tài khoản

```bash
ngrok config add-authtoken YOUR_TOKEN
```

### Bước 3: Chạy Laravel

```bash
php artisan serve
```

### Bước 4: Chạy ngrok

```bash
ngrok http 8000
```

### Bước 5: Lấy URL HTTPS

Ví dụ:

```
https://abc123.ngrok-free.app
```

### Bước 6: Cấu hình Facebook

Trong Facebook Developer → Facebook Login → Settings:

```
https://abc123.ngrok-free.app/auth/facebook/callback
```

### Bước 7: Cập nhật .env

```env
FACEBOOK_REDIRECT_URI=https://abc123.ngrok-free.app/auth/facebook/callback
```

### Lưu ý:

* URL ngrok sẽ thay đổi mỗi lần chạy
* Cần cập nhật lại khi restart ngrok


# ⚙️ 4. Cấu hình Laravel Socialite

Mở file `config/services.php`:

```php
return [

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT_URI'),
    ],

    'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID'),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
        'redirect' => env('FACEBOOK_REDIRECT_URI'),
    ],

];
```

---

# 👤 5. Chức năng chính

* Đăng nhập bằng Google
* Đăng nhập bằng Facebook
* Lưu thông tin người dùng (name, email, avatar)
* Nếu user tồn tại → đăng nhập
* Nếu chưa → tạo mới
* Hiển thị thông tin người dùng
* Đăng xuất (logout)
* Xử lý lỗi đăng nhập

---

# ⚠️ 6. Lưu ý

* Không commit file `.env` lên GitHub
* Phải chạy:

```bash
php artisan config:clear
```

sau khi sửa `.env`

* Nếu lỗi OAuth:

  * Kiểm tra đúng Redirect URI
  * Kiểm tra App đã bật public (Facebook)

---

# ✅ 7. Kết luận

Dự án đã triển khai thành công chức năng đăng nhập bằng Google và Facebook sử dụng OAuth 2.0 với Laravel Socialite, đáp ứng đầy đủ yêu cầu đề bài.

---
