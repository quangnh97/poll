# poll
- Yêu cầu: PHP, Laravel
- Công cụ: XAMPP (có thể dùng cái khác)
- Tự tạo project mới tại máy local rồi pull code từ github về 
+ do tải code từ github về sẽ không có 1 số file quan trọng: vendor (core laravel), .env (kết nối CSDL, có thể copy file .env.example rồi đỏie tên thành .env), ...
- Tạo CSDL mới trên máy local (tên gì cũng được, VD: poll)
- Kết nối CSDL xong xuôi thì bật terminal chạy lệnh: php artisan migrate (để tạo các bảng trong CSDL)
