# Hướng dẫn chạy dự án team.tienziven.com trong Docker

## Yêu cầu hệ thống
- Docker Engine
- Docker Compose

## Các bước thiết lập

### 1. Clone dự án về máy local

```bash
git clone <repository_url>
cd team.tienziven.com
```

### 2. Chạy dự án với Docker Compose

```bash
docker-compose up -d
```

Lệnh này sẽ:
- Tạo và khởi động các container cho PHP+Apache, MySQL và phpMyAdmin
- Import dữ liệu từ file `maoknyyx_perfex.sql` vào cơ sở dữ liệu

### 3. Truy cập ứng dụng

- Website: http://localhost:8080
- phpMyAdmin: http://localhost:8081
  - Username: perfex_user
  - Password: perfex_password

### 4. Dừng dự án

```bash
docker-compose down
```

### 5. Xóa dữ liệu và chạy lại

Nếu bạn muốn xóa hết dữ liệu và chạy lại từ đầu:

```bash
docker-compose down -v
docker-compose up -d
```

## Lưu ý quan trọng

1. Đã thay đổi cấu hình kết nối cơ sở dữ liệu trong file `app-config-docker.php` để phù hợp với môi trường Docker.
2. Port mặc định đã được thiết lập là:
   - Website: 8080
   - MySQL: 3306
   - phpMyAdmin: 8081

   Bạn có thể thay đổi các port này trong file `docker-compose.yml` nếu cần.
3. Thông tin đăng nhập cơ sở dữ liệu:
   - Host: db
   - Database: perfex
   - Username: perfex_user
   - Password: perfex_password
   - Root password: root_password 