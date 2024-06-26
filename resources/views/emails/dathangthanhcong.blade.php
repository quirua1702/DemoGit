<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Đặt hàng thành công - {{ config('app.name', 'Laravel') }}</title>
    <style>
        table {
        border-collapse: collapse;
        width: 100%;
        }
        p {
        margin-top: 3px;
        margin-bottom: 3px;
        }
    </style>
</head>
    <body>
        <p>Xin chào {{ Auth::user()->name }}!</p>
        <p>Xin cảm ơn bạn đã đặt hàng tại {{ config('app.name', 'Mobifone') }}.</p>
        <p>Mã đơn hàng: {{rand(10000,999)}}</p>
        <p>- Điện thoại: <strong>{{ $donhang->dienthoai }}</strong></p>
        <p>Thông tin đơn hàng bao gồm:</p>
        <table border="1">
    <thead>
        <tr>
            <th width="5%">#</th>
            <th with="55%">Gói data</th>
            <th width="5%">SL</th>
            <th width="15%">Đơn giá</th>
            <th width="20%">Thành tiền</th>
        </tr>
    </thead>
    <tbody>
        @php $tongtien = 0; @endphp
        @foreach($donhang->DonHang_ChiTiet as $chitiet)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $chitiet->GoiData->tengoicuoc }}</td>
                <td>{{ $chitiet->soluongban }}</td>
                <td style="text-align:right">
                {{ number_format($chitiet->dongiaban) }}<sup><u>đồng</u></sup>
                </td>

                <td style="text-align:right">

                {{ number_format($chitiet->soluongban * $chitiet->dongiaban) }}<sup><u>đ</u></sup>
                </td>
            </tr>
        @php $tongtien += $chitiet->soluongban * $chitiet->dongiaban; @endphp
        @endforeach
            <tr>
                <td colspan="4">Tổng tiền sản phẩm:</td>
                <td style="text-align:right">
                <strong>{{ number_format($tongtien) }}</strong><sup><u>đ</u></sup>
                </td>
            </tr>
    </tbody>
    </table>
    <p>Trân trọng,</p>
    <p>{{ config('app.name', 'Mobifone') }}</p>
    </body>
</html>