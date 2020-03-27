# Công cụ tạo tin tự động trên trang facebook lấy nguồn trực tiếp từ Vnexpress
Code này được dùng để tạo tin tức tự động trên trang fanpage để tăng lượt tiếp cận của trang. Bộ code này được chia làm 2 phần:
* API lấy tin tự được viết bằng php
* Phần đăng tin tự động được viết bằng python

## Cấu hình cho bộ code
### Cấu hình cho API lấy tin tự động
Để tạo API thực hiện lấy tin tự động, đầu tiên bạn upload nội dung thư mục `php` lên hosting. 
Sau đó truy cập thử vào địa chỉ web của bạn ví dụ [http://localhost]/get_news.php để xem code đã chạy chưa, nếu kết quả trả về là danh sách các bài viết kèm link + tiêu đề nghĩa là code đã chạy. Bạn copy đường dẫn của web bạn để thực hiện bước sau.
### Cấu hình phần đăng tin tự động
Yêu cầu:
* Máy được cài python3
* Cài sẵn pip3
Để cấu hình cho phần đăng tin tự động, bạn phải cài các gói thư viện của python:
```bash
$ pip3 install imgkit
$ pip3 install requests
```
Sau đó vào cấu hình file config.py trong thư mục python, sửa nội dung file với:
```python
FACEBOOK_CONFIG = {
    "page_id": "<page-id-cua-ban>",
    "facebook_token": "<page-token-cua-ban>",
}
HTML_BASE_URL = '<dia-chi-web-php>'
IMG_WIDTH = 651

IMGBB_KEY = '6f3c9d46411e856143550c079c8248ce'
```
Bạn thay `<page-token-cua-ban>` thành access_token trang facebook của bạn, `<page-id-cua-ban>` chính là id page
và cuối cùng là `<dia-chi-web-php>` chính là địa chỉ web của phần cấu hình API bên trên.
## Chạy code
Để tiến hành đăng tin, bạn chỉ cần chạy file main.py như sau:

```bash
$ python3 main.py
```

Kết quả sẽ là 
```
Tạo thành công ...16 Ảnh
Đăng thành công ....16 Ảnh
Loading page (1/2)
Rendering (2/2)                                                    
Done                                                               
Tạo thành công ...17 Ảnh
Đăng thành công ....17 Ảnh
....Đang đăng bài viết
Đăng thành công!

```

Bây giờ thì vào fanpage kiểm tra thôi :))

## Đăng tự động theo ngày
Để đăng tự động theo ngày và vào 1 giờ cố định, ta làm như sau (linux):
* Cho phép thực thi file main.py:
```bash
$ chmod +x main.py
```
Sau đó thêm vào crontab
```bash
$ sudo crontab -e 
```
Sau đó thêm dòng này vào cuối file (chạy lúc 7h sáng mỗi ngày):
```bash
*0 7 * * *  /usr/bin/env python3 /path/to/main.py
```

Cuối cùng khởi động lại:

```bash
$ sudo /etc/init.d/crond restart
```
