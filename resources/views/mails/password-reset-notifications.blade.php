<div style="font-family: Arial, sans-serif; max-width: 600px; margin: auto; padding: 20px; border: 1px solid #e0e0e0; border-radius: 10px; background-color: #f9f9f9;">
    <h2 style="color: #333;">Chào bạn {{ $name }},</h2>
    
    <p style="font-size: 16px; color: #555;">
        Bạn đã yêu cầu thay đổi mật khẩu cho tài khoản của mình. Vui lòng nhấn vào nút bên dưới để tiếp tục quá trình.
    </p>

    <div style="text-align: center; margin: 30px 0;">
        <a href="{{ route('reset', $token) }}" style="background-color: #007bff; color: white; text-decoration: none; padding: 12px 24px; border-radius: 6px; font-size: 16px;">
            Thay đổi mật khẩu
        </a>
    </div>

    <p style="font-size: 14px; color: #888;">
        Nếu bạn không yêu cầu thay đổi mật khẩu, vui lòng bỏ qua email này. Không cần thực hiện thêm hành động nào.
    </p>

    <p style="font-size: 14px; color: #aaa; margin-top: 40px;">
        Trân trọng,<br>
        Đội ngũ hỗ trợ
    </p>
</div>

