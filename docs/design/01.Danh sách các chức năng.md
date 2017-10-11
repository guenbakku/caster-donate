# Danh sách các chức năng

1. **Thành viên bình thường:**
    1. Username, password đăng nhập
    1. Profile:
        1. Tên/Nickname
        1. Ngày sinh nhật
        1. Email
        1. Facebook
        1. Zalo
        1. Số điện thoại
        1. Lời giới thiệu
        1. Ảnh đại diện
        1. Số dư trong ví (đơn vị tiền là xu hoặc gì đấy)
    1. Các tính năng khác của user (xác nhận email, quên mật khẩu, biên tập profile...)

1. **Đăng ký làm LiveStreamer: (bao gồm các thông tin bên trên cộng thêm các chức năng dưới đây)**
    1. Chức năng đăng ký:
        1. Nộp ảnh CMND
        1. Ký hợp đồng điện tử
        1. Đăng ký thể loại LiveStream (Dota, Lol, Học tiếng Nhật, ….)
    1. Thông tin LiveStreamer:
        1. Link donate (ví dụ: tenewebsite.com/XYZ )
        1. % lệ phí (default là 10%, khi khuyến mãi thì có thể giảm % đến khoảng    thời gian nào đấy)
        1. Thông tin chuyển khoản:
        1. Tên ngân hàng
        1. Số tài khoản
        1. Tên chủ tài khoản
        1. (Chi nhánh )
    1. Thống kê:
        1. Thu nhập hằng tháng
        1. Log thông tin donate
    1. Tùy chọn cho LiveStreamer:
        1. Ảnh donate (Những gì sẽ thể hiện trên màn hình livestream)
        1. Audio donate 
        1. Tiêu đề Donate (ví dụ: A đã ủng hộ B số tiền 10000đ)

1. **Thông tin ủng hộ:**
    1. Ngày giờ
    1. Tên người ủng hộ (có thể là tên đơn thuần cho người không phải thành viên hoặc là tên và link của thành viên đã ủng hộ)
    1. Số xu(?) ủng hộ
    1. Phân loại ủng hộ: chỉ ủng hộ thường hoặc có kèm đậu, hoa hồng, kim cương, phân, gạch, búa, đá v..v… Nếu ủng hộ thường thì sẽ sử dụng tùy chọn của   LiveStreamer ở mục 2.d để hiển thị. Nếu ủng hộ có kèm hiệu ứng thì sẽ hiển    thị theo hiệu ứng đã thiết lập của website.
    1. Phương thức ủng hộ (thẻ Mobiphone, Viettel,... , MasterCard, Visa... ,VCB, SCB,...)
    1. Lời nhắn

1. **Chức năng Admin:**
    1. Thống kê tiền vào ra hằng tháng
    1. Chốt sổ tiền gửi cho LiveStreamer mỗi đầu tháng (hoặc 2 lần 1 tháng)
    1. Xem log thu nhập của thành viên
    1. Khóa/Mở tài khoản

1. **Chức năng có thể phát triển về sau:**
    1. Thành viên có thể gửi thông điệp đến admin nhờ trợ giúp, khiếu nại, thắc    mắc v.v.. (ban đầu sẽ thực hiện qua email).
    1. Mặt cảm xúc trong thông điệp ủng hộ.
    1. LiveStreamer có thể biên tập lịch LiveStream của mình và hiển thị bên   profile. Donater(hoặc có thể hiểu là thành viên bình thường) có thể thêm  LiveStreamer vào Favorite và nhận được hiển thị buổi livestream gần nhất     trên website.
    1. Lập kế hoạch ủng hộ: Một LiveStream có thể đặt mục tiêu (ví dụ như  laptop,ghế game,iphone v.v..) với một số tiền cụ thể trong 1 khoảng thời     gian cụ thể, và hiển thị phần trăm kế hoạch đã đạt được trên màn hình.
    1. Cho người dùng xem quảng cáo để có thu nhập xu.
    1. Share để nhận xu.

1. **Kỹ thuật cần ứng dụng:**
    1. Invisible Google Captcha
    1. Giọng đọc google
    1. Hệ thống thanh toán
    1. Bảo mật SSL
    1. Hợp đồng điện tử (chưa biết)
    1. Chức năng gửi tiền hàng loạt qua ngân hàng (không biết có không, hay phải thực hiện thủ công)