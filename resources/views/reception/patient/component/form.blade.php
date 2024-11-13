
<div class="form">
    <h2>Phiếu Khám Bệnh</h2>

    <!-- Thông tin chung -->
    <div class="section">
        <h3>Thông Tin Chung</h3>
        <table class="info-table">
            <tr>
                <th>Trạng thái phiếu khám</th>
                <td>Đang mở</td>
            </tr>
            <tr>
                <th>Thời gian vào viện</th>
                <td>10:38, 11/11/2024</td>
            </tr>
        </table>
    </div>

    <!-- Thông tin bệnh nhân -->
    <div class="section">
        <h3>Thông Tin Bệnh Nhân</h3>
        <table class="info-table">
            <tr>
                <th>Họ và tên</th>
                <td>[Tên bệnh nhân]</td>
            </tr>
            <tr>
                <th>Ngày sinh</th>
                <td>[Ngày sinh bệnh nhân]</td>
            </tr>
            <tr>
                <th>Giới tính</th>
                <td>[Nam/Nữ]</td>
            </tr>
            <tr>
                <th>Địa chỉ</th>
                <td>[Địa chỉ bệnh nhân]</td>
            </tr>
            <tr>
                <th>Liên hệ</th>
                <td>[Số điện thoại]</td>
            </tr>
        </table>
    </div>

    <!-- Chi tiết vấn đề sức khỏe -->
    <div class="section">
        <h3>Chi Tiết Vấn Đề Sức Khỏe</h3>
        <table class="info-table">
            <tr>
                <th>Triệu chứng chính</th>
                <td>Đau đầu, chóng mặt</td>
            </tr>
            <tr>
                <th>Chẩn đoán sơ bộ</th>
                <td>[Chẩn đoán của bác sĩ]</td>
            </tr>
            <tr>
                <th>Phòng khám</th>
                <td>[Tên phòng khám hoặc khoa]</td>
            </tr>
            <tr>
                <th>Bác sĩ phụ trách</th>
                <td>[Tên bác sĩ phụ trách]</td>
            </tr>
        </table>
    </div>

    <!-- Kế hoạch điều trị -->
    <div class="section">
        <h3>Kế Hoạch Điều Trị</h3>
        <table class="info-table">
            <tr>
                <th>Xét nghiệm và chỉ định</th>
                <td>[Danh sách xét nghiệm và các chỉ định của bác sĩ]</td>
            </tr>
            <tr>
                <th>Thuốc điều trị</th>
                <td>[Tên thuốc và liều lượng được chỉ định]</td>
            </tr>
            <tr>
                <th>Lịch tái khám</th>
                <td>[Ngày giờ tái khám, nếu có]</td>
            </tr>
        </table>
    </div>

    <!-- Ghi chú bổ sung -->
    <div class="section">
        <h3>Ghi Chú Bổ Sung</h3>
        <table class="info-table">
            <tr>
                <th>Lưu ý và dặn dò</th>
                <td>[Các lưu ý chăm sóc và theo dõi từ bác sĩ]</td>
            </tr>
        </table>
    </div>

    <p style="text-align: right; margin-top: 20px;">
        <strong>Ký tên bác sĩ:</strong> _________________________ <br>
        <strong>Ngày ký:</strong> [Ngày khám]
    </p>
</div>

<style>
    body {
        font-family: Arial, sans-serif;
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f4f4f4;
    }
    h1, h2 {
        text-align: center;
        color: #333;
    }
    .section {
        background-color: #fff;
        padding: 15px;
        margin-bottom: 10px;
        border-radius: 8px;
        box-shadow: 0px 0px 5px rgba(0,0,0,0.1);
    }
    .section h3 {
        color: #007BFF;
        margin-top: 0;
    }
    .info-table {
        width: 100%;
        border-collapse: collapse;
    }
    .info-table th, .info-table td {
        text-align: left;
        padding: 8px;
        border-bottom: 1px solid #ddd;
    }
    .info-table th {
        background-color: #f8f8f8;
        color: #555;
    }
</style>