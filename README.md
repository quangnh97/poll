# poll
- Yêu cầu: PHP, Laravel
- Công cụ: XAMPP (có thể dùng cái khác)
- Tự tạo project mới tại máy local rồi pull code từ github về 
+ do tải code từ github về sẽ không có 1 số file quan trọng: vendor (core laravel), .env (kết nối CSDL, có thể copy file .env.example rồi đỏie tên thành .env), ...
- Tạo CSDL mới trên máy local (tên gì cũng được, VD: poll)
- Kết nối CSDL xong xuôi thì bật terminal chạy lệnh: php artisan migrate (để tạo các bảng trong CSDL)

# Các bước cài đặt
-B0: cài đặt các tool
+XAMPP: https://www.apachefriends.org/download.html \n
+Git: https://git-scm.com/ \n
+Composer: https://getcomposer.org/download/ \n
+Laravel: mở cmd và chạy lệnh: composer global require laravel/installer \n

-B1: tạo project Laravel, mở git bash tại thư mục muốn tạo và chạy lệnh:
$ git clone https://github.com/namhd1204/poll.git
$ cd poll
$ composer install
$ php artisan key:generate

-B2: tạo database:
+vào thư mục chứa source code, copy file .env.example và paste ngay tại thư mục và đổi tên thành .env \n
+mở XAMPP và cho chạy 2 dịch vụ Apache và MySQL \n
+mở trình duyệt: http://localhost/phpmyadmin/ \n
+tạo database mới có tên: laravel \n
+tại git bash chạy: $ php artisan migrate \n

-B3: để chạy project, 
+chạy lệnh sau: $ php artisan serve \n
+mở trình duyệt và chạy: http://localhost:8000/ \n
